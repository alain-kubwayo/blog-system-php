<?php

include('functions.php');

// echo $_GET['activity'];

$json = file_get_contents('data.json');
$data = json_decode($json, 1); // 1 => true to say we want to turn it into an associative array
if(is_array($data)){
    krsort($data);
}

switch($_GET['mode']) {
    case "status":
        $id = $_GET["id"];
        $data[$id]['status'] = 1;
        save($data);

        break;

    case "remove":
        $id = $_GET["id"];
        $data[$id]['status'] = 2;
        save($data);

        break;
    case "stop":
        $id = $_GET["id"];
        $data[$id]['date_end'] = time();
        save($data);

        break;
    case "new":
        $time = time();
        $data[$time]['id'] = $time;
        $data[$time]['name'] = $_GET['activity']; // sent from from
        $data[$time]['date_start'] = $time;
        $data[$time]['date_end'] = '';
        $data[$time]['status'] = 1;
        save($data);

        break;
    case "tally":
        $count = 0;
        if(is_array($data)){
            foreach($data as $activity) {
                if($activity['status'] == 1) {
                    if($activity['date_end'] == "") {
                        $activity['date_end'] = time(); 
                    }
                    $count = $count + ($activity['date_end'] - $activity['date_start']);
                }
            }
        }
        echo formatTime($count);
        break;


    case "build":
        if(is_array($data)){
        foreach($data as $activity) { 
            if($activity['status'] == 1) {
            ?>

            <tr class="bg-gray-300 border border-grey-500 md:border-none block md:table-row">
                <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span class="inline-block w-1/3 md:hidden font-bold">Name</span><?= $activity['name'] ?></td>
                <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span class="inline-block w-1/3 md:hidden font-bold">Start</span><?= formatDate($activity['date_start']) ?></td>
                <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span class="inline-block w-1/3 md:hidden font-bold">Finish</span>
                <?php 
                    if($activity['date_end'] != "") {
                        echo formatDate($activity['date_end']);
                    }
                ?>
                </td>
                <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span class="inline-block w-1/3 md:hidden font-bold">
                    Time</span>
                <?= $activity['date_end'] == "" ? formatTime(time() - $activity['date_start']) : formatTime($activity['date_end'] - $activity['date_start']) ?>
                </td>
                <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                    <button data-id="<?= $activity['id'] ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 border border-blue-500 rounded btn-stop" <?= $activity['date_end'] != "" ? "disabled" : "" ?>><?= generateButtonContent("Stop") ?></button>
                    <button data-id="<?= $activity['id'] ?>" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 border border-red-500 rounded btn-remove"><?= generateButtonContent("Delete") ?></button>
                </td>
            </tr>
        <?php }}};
        break;

        case "restore":
            if(is_array($data)){
            foreach($data as $activity) { 
                if($activity['status'] == 2) {
                ?>
    
                <tr class="bg-gray-300 border border-grey-500 md:border-none block md:table-row">
                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span class="inline-block w-1/3 md:hidden font-bold">Name</span><?= $activity['name'] ?></td>
                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span class="inline-block w-1/3 md:hidden font-bold">Start</span><?= formatDate($activity['date_start']) ?></td>
                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span class="inline-block w-1/3 md:hidden font-bold">Finish</span>
                    <?php 
                        if($activity['date_end'] != "") {
                            echo formatDate($activity['date_end']);
                        }
                    ?>
                    </td>
                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span class="inline-block w-1/3 md:hidden font-bold">
                        Time</span>
                    <?= $activity['date_end'] == "" ? formatTime(time() - $activity['date_start']) : formatTime($activity['date_end'] - $activity['date_start']) ?>
                    </td>
                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                        <button data-id="<?= $activity['id'] ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 border border-blue-500 rounded btn-stop" <?= $activity['date_end'] != "" ? "disabled" : "" ?>></button>
                        <button data-id="<?= $activity['id'] ?>" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 border border-red-500 rounded btn-restore"><?= generateButtonContent("Restore") ?></button>
                    </td>
                </tr>
            <?php }}};
            break;
}
?>