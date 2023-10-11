<?php include("functions.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Time Tracker</title>
</head>
<body class="max-w-3xl mx-auto">
    <h1 class="text-red-600">Time Tracker</h1>
    <div class="grid grid-cols-2 gap-x-10">
        <div>
            <a class="underline text-blue-500" data-mode="restore" id="btn-mode" href="#"><span id="label-mode">Restore</span> Mode</a>
        </div>
        <div>
            Total Time: <span id="tally"></span>
        </div>
    </div>
    <form class="grid grid-cols-2 gap-x-10" id="form-new">
        <input class="border border-blue-300 outline-none" id="activity" name="activity" type="text" placeholder="Enter activity">
        <div>
            <button type="submit" class="px-2 py-1 bg-sky-400">Start</button>
        </div>
    </form>

    <!-- component -->
<table class="min-w-full border-collapse block md:table">
		<thead class="block md:table-header-group">
			<tr class="border border-grey-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto  md:relative ">
				<th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Activity</th>
				<th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Start</th>
				<th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Finish</th>
				<th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Time</th>
				<th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Actions</th>
			</tr>
		</thead>
		<tbody class="block md:table-row-group" id="log">
            		
		</tbody>
	</table>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="tracker.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</body>
</html>