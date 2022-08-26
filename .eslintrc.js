module.exports = {
  env: {
    browser: true,
    es2021: true,
  },
  extends: ['plugin:react/recommended', 'airbnb'],
  parserOptions: {
    ecmaFeatures: {
      jsx: true,
    },
    ecmaVersion: 12,
    sourceType: 'module',
  },
  plugins: ['react'],
  rules: {
    'eslint-disable react/no-this-in-sfc': 0,
    'eslint-disable react/jsx-filename-extension': 0,
    'eslint-disable no-restricted-syntax': 0,
    'eslint-disable no-extend-native': 0,
    'eslint-disable jsx-a11y/heading-has-content': 0,
    'eslint-disable react/jsx-indent': 0,
    'eslint-disable quotes': 0,
    'linebreak-style': 0,
    // suppress errors for missing 'import React' in files
    'react/react-in-jsx-scope': 0,
    // allow jsx syntax in js files (for next.js project)
    'react/prop-types': 0,
    'jsx-a11y/label-has-associated-control': [
      'error',
      {
        required: {
          some: ['nesting', 'id'],
        },
      },
    ],
    'jsx-a11y/label-has-for': [
      'error',
      {
        required: {
          some: ['nesting', 'id'],
        },
      },
    ],
    'no-console': 'off',
    'no-multiple-empty-lines': 0,
    'object-curly-newline': [
      'error',
      {
        ObjectExpression: 'always',
        ObjectPattern: {
          multiline: true,
        },
        ImportDeclaration: 'never',
        ExportDeclaration: {
          multiline: true,
          minProperties: 3,
        },
      },
    ],
  },
};
