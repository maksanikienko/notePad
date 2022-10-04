<?php
function add_item(int $id, int $workoutNumber, string $name, $date, $time) {
    
    $content = json_decode(file_get_contents("data.json"), true);
    array_push($content,['id'=>$id, 'WorkoutNumber'=>$workoutNumber, 'Name'=>$name, 'Date'=>$date,'Time'=>$time]);
    file_put_contents("data.json", json_encode($content,JSON_PRETTY_PRINT));

    print "New item ID '$id' was added." . PHP_EOL; 
};

function update_item(int $id, int $workoutNumber, string $name, $date, $time)
{
    $content = json_decode(file_get_contents("data.json"), true);

    foreach ($content as $key => $value) {

        if ($value['id'] === $id) {

            $content[$key]['WorkoutNumber'] = $workoutNumber;
            $content[$key]['Name'] = $name;
            $content[$key]['Date'] = $date;
            $content[$key]['Time'] = $time;

            print "Item with ID '$id' was updated." . PHP_EOL;
        }
    }

    file_put_contents("data.json", json_encode($content,JSON_PRETTY_PRINT));
};

function delete_item(int $id) 
{
    $content = json_decode(file_get_contents("data.json"), true);

    foreach ($content as $key => $value) {
        if ($value['id'] === $id) {
                unset($content[$key]);
            
            print "Item with ID '$id' was deleted." . PHP_EOL;
        }
    };

    file_put_contents("data.json", json_encode($content,JSON_PRETTY_PRINT));
};

function get_help()
{
    return
        "Usage:    php script.php <command> <...arguments>" . PHP_EOL .
        "Commands:" . PHP_EOL .
        "   read                  - display records from the storage"  . PHP_EOL .
        "   add    <content>      - add a records to the storage" . PHP_EOL .
        "   edit   <id> <content> - edit a records from the storage" . PHP_EOL .
        "   delete <id>           - delete a records from the storage" . PHP_EOL .
        "   help                  - display this message" . PHP_EOL;
}