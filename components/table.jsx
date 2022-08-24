import { useMemo } from 'react';
import { useTable, useFilters } from 'react-table';
import { DefaultColumnFilter } from './Filters';

export const fuzzyTextFilterFn = (rows, id, filterValue) => matchSorter(rows, filterValue, { keys: [(row) => row.values[id]] });

// Let the table remove the filter if the string is empty
fuzzyTextFilterFn.autoRemove = (val) => !val;

const Table = ({
  data,
  columns,
}) => {
  const filterTypes = useMemo(
    () => ({
      // Add a new fuzzyTextFilterFn filter type.
      fuzzyText: fuzzyTextFilterFn,
      // Or, override the default text filter to use
      // "startWith"
      text: (rows, id, filterValue) => rows.filter((row) => {
        const rowValue = row.values[id];
        return rowValue !== undefined
          ? String(rowValue)
            .toLowerCase()
            .startsWith(String(filterValue).toLowerCase())
          : true;
      }),
    }),
    [],
  );

  const defaultColumn = useMemo(
    () => ({
      // Let's set up our default Filter UI
      Filter: DefaultColumnFilter,
    }),
    [],
  );

  const {
    getTableProps,
    getTableBodyProps,
    headerGroups,
    rows,
    prepareRow,
  } = useTable({
    columns, data, defaultColumn, filterTypes,
  },
  useFilters);

  return (
    // eslint-disable-next-line react/jsx-props-no-spreading
    <table className="min-w-full divide-y divide-gray-200" {...getTableProps()}>
      <thead className="bg-gray-50 dark:bg-primary-dark">
        {headerGroups.map((headerGroup) => (
          // eslint-disable-next-line react/jsx-props-no-spreading
          <tr {...headerGroup.getHeaderGroupProps()}>
            {headerGroup.headers.map((column) => {
              // eslint-disable-next-line no-nested-ternary
              const isSorted = column.isSorted ? column.isSortedDesc ? ' 🔽' : ' 🔼' : '';

              return (
                <th
                  // eslint-disable-next-line react/jsx-props-no-spreading
                  {...column.getHeaderProps({
                    className: column.className || `text-gray-600 dark:text-white px-6 py-3 text-left text-xs
                      uppercase tracking-wider dark:bg-primary-dark cursor-pointer`,
                  })}
                >
                  {column.render('Header')}
                  <span>
                    {isSorted}
                  </span>
                  <div className="mt-2">{column.canFilter ? column.render('Filter') : null}</div>
                </th>
              );
            })}
          </tr>
        ))}
      </thead>
      <tbody
        className="bg-white divide-y divide-gray-200 text-xs
                  dark:bg-base-dark dark:divide-gray-600"
        {...getTableBodyProps()}
      >
        {rows.map((row, i) => {
          prepareRow(row);
          return (
            <tr
              key={i}
              // eslint-disable-next-line react/jsx-props-no-spreading
              {...row.getRowProps({
                className: row.className || 'hover:bg-gray-200 dark:hover:bg-gray-700',
              })}
            >
              {row.cells.map((cell) => (
                <td
                  // eslint-disable-next-line react/jsx-props-no-spreading
                  {...cell.getCellProps({
                    className: cell.className || 'px-6 py-4',
                  })}
                >
                  {cell.render('Cell')}
                </td>
              ))}
            </tr>
          );
        })}
      </tbody>
    </table>
  );
};

export default Table;
