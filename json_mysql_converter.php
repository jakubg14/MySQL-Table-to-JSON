<?php
    function mysql_to_json($connection_name, $table_name, $file_name){
        
        // Verifies that table name and connection to MySQL exist.
        if(!$connection_name || !$table_name)
            return false;
        
        // If the user did not enter a desired file name, a unique one will be initiated.         
        if(!$file_name)
            $file_name = "new_json_file" . idate("U");           
        
        // Type casts input variables to strings in the case that the user entered a different variable type. 
        $table_name = string($table_name);        
        $file_name = string($file_name);
        
        
        // Query data from MySQL server.
        $data_query = "SELECT * FROM $table_name";
        $data_request = @mysqli_query($connection_name, $data_query);
        
        // Insert queried data into an array.
        $data_saved[] = array();
        while($entry = mysqli_fetch_assoc($data_request))
        {
            $data_saved[] = $entry;
        }
        
        // Copy array data to file.
        $file_wrtie = fopen($file_name, 'w');
        fwrite($file_write, json_encode($data_saved));
        fclose($file_write);
        
        // Return true to let the user know that everything ran successfully. 
        return true;
    }



?>