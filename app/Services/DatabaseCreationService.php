<?php

namespace App\Services;

class DatabaseCreationService
{
    public function create($dbname)
    {
        $scriptPath = '/home/automation/database_creation_script/databasecreation.sh'; // Replace with the actual path to your database script
        // $dbname = 'new_database'; //  The database name you want to pass 
        // /home/automation/database_creation_script/databasecreation.sh 
        // Ensure the script exists and is executable
        if (!file_exists($scriptPath) || !is_executable($scriptPath)) {
            die("Error: Script not found or not executable at '$scriptPath'. Please check the path and permissions.\n");
        }
        
        // Sanitize the database name for security
        $safeDbname = escapeshellarg($dbname);
        
        // Construct the command with the dbname argument
        $command = $scriptPath . ' ' . $safeDbname;
        
        $output = shell_exec($command);
        
        echo "<h2>Calling Database Script with dbname from PHP</h2>";
        echo "<p>Calling script: <code>" . htmlspecialchars($command) . "</code></p>";
        echo "<p>Database Name passed: <code>" . htmlspecialchars($dbname) . "</code></p>";
        
        if ($output !== null) {
            echo "<h3>Script executed successfully. Output:</h3>";
            echo "<pre>";
            echo htmlspecialchars($output);
            echo "</pre>";
        } else {
            echo "<p style='color: red;'>Error executing script '$scriptPath'. Check script permissions and output for errors.\n";
        }
        
        
        return $output;
    }
    // public function create()
    // {
    //     $scriptPath = '/home/automation/database_creation_script/databasecreation.sh'; // Replace with the actual path to your database script
    //     $dbname = 'new_database'; //  The database name you want to pass 
    //     // /home/automation/database_creation_script/databasecreation.sh 
    //     // Ensure the script exists and is executable
    //     if (!file_exists($scriptPath) || !is_executable($scriptPath)) {
    //         die("Error: Script not found or not executable at '$scriptPath'. Please check the path and permissions.\n");
    //     }
        
    //     // Sanitize the database name for security
    //     $safeDbname = escapeshellarg($dbname);
        
    //     // Construct the command with the dbname argument
    //     $command = $scriptPath . ' ' . $safeDbname;
        
    //     $output = shell_exec($command);
        
    //     echo "<h2>Calling Database Script with dbname from PHP</h2>";
    //     echo "<p>Calling script: <code>" . htmlspecialchars($command) . "</code></p>";
    //     echo "<p>Database Name passed: <code>" . htmlspecialchars($dbname) . "</code></p>";
        
    //     if ($output !== null) {
    //         echo "<h3>Script executed successfully. Output:</h3>";
    //         echo "<pre>";
    //         echo htmlspecialchars($output);
    //         echo "</pre>";
    //     } else {
    //         echo "<p style='color: red;'>Error executing script '$scriptPath'. Check script permissions and output for errors.\n";
    //     }
        

    //     return $output;
    // }
}
