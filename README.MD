# Expense Tracker

A simple expense tracker built in Laravel. The whole purpose of this project is to show you how to integrate PDF Reader, PDF Generator and Chart into Laravel project.

## Features
- Input expense
- Track expense monthly
- Track expense yearly
- Export report to PDF
- Show report in PDF

## Schema
1. User (Breeze bundle)
2. ExpenseItem
- name
- category_id
- user_id
- date
- cost
3. ExpenseCategory
- name
- user_id
4. Report
- user_id
- description
- file
