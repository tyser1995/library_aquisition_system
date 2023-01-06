<?php

namespace App\Imports;

use App\Models\AccessionBook;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;

class AccessionBookImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // dd($row);
        return new AccessionBook([
            'date_received' => $row['date_received'],
            'accession_no' => $row['accession_no'], 
            'author'=> $row['author'],  
            'title'=> $row['title'], 
            'edition' => $row['edition'], 
            'volume'=> $row['volume'], 
            'pages'=> $row['pages'], 
            'dealers'=> $row['dealers'], 
            'price'=> $row['price'], 
            'publisher'=> $row['publisher'], 
            'publication'=> $row['publication'],
            'copyright_date'=> $row['copyright_date'], 
            'isbn'=> $row['isbn'], 
            'recommended_by'=> $row['recommended_by'], 
            'department_name'=> $row['department_name'], 
            'section_name'=> $row['section_name'], 
            'acct_name'=> $row['acct_name'], 
            'acct_no'=> $row['acct_no'], 
            'actual_price'=> $row['actual_price'], 
            'less_percentage'=> $row['less_percentage'], 
            'price_discounted'=> $row['price_discounted'], 
            'discount'=> $row['discount'], 
            'dr_no'=> $row['dr_no'], 
            'receipt_no'=> $row['receipt_no'], 
            'status'=> $row['status']
        ]);
    }
}
