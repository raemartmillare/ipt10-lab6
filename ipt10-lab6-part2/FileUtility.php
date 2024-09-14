<?php

class FileUtility
{
    // Write data to a CSV file
    public static function writeToFile($fileName, $data)
    {
        $file = fopen($fileName, 'w');
        // Write headers
        fputcsv($file, [
            'UUID', 'Title', 'First Name', 'Last Name', 'Street Address', 'Barangay', 
            'Municipality', 'Province', 'Country', 'Phone Number', 'Mobile Number', 
            'Company Name', 'Company Website', 'Job Title', 'Favorite Color', 
            'Birthdate', 'Email Address', 'Password'
        ]);

        // Write data rows
        foreach ($data as $row) {
            fputcsv($file, $row);
        }
        fclose($file);
    }

    // Read data from a CSV file
    public static function readFromFile($fileName)
    {
        if (!file_exists($fileName)) {
            return [];
        }

        $file = fopen($fileName, 'r');
        $data = [];
        $headers = fgetcsv($file); // Get the headers

        // Loop through the file and get each row
        while (($row = fgetcsv($file)) !== false) {
            // Only combine if the row has the same number of columns as the header
            if (count($headers) === count($row)) {
                $data[] = array_combine($headers, $row);
            } else {
                // Handle mismatch, skip the row or log an error
                // echo "Row skipped due to column mismatch";
                continue;
            }
        }

        fclose($file);
        return $data;
    }
}
