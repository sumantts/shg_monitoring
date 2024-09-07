<?php
	//echo "DB Connection start here";

	session_start();
	
  	$p_name = 'Bagnan Mahila Bikash';
	$logo = 'logo.jpg';
	$ico = 'logo-mahila.ico';

	//Mysqli DB Connection Procedural style
	$host_name = "localhost";
	$user_name = "root";
	$password = "";
	$db_name = "pioneers_shg_monitoring";

	$con = mysqli_connect($host_name, $user_name, $password, $db_name);
	
	// Check connection
	if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	exit();
	}

	// Change database to "GFG_TEST"
	// mysqli_select_db($conn,$dbtest);
	
	/***************
	// Check connection
	if (mysqli_connect_errno()) {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  exit();
	}else{
		//Fetch Query
		$sql = "SELECT * FROM mst_module";
		$res = mysqli_query($con, $sql);
		if(mysqli_num_rows($res) > 0){
			while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
				//echo $row['Module_Id'].' -- '.$row['Module_Name'];
				//echo "<br>";
			}//end while
		}
	}
	
	//run the store proc
	$result = mysqli_query($con, "CALL usp_LogInAcYr");

	//loop the result set
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){   
		//echo $row['YrId'].' -- '.$row['FinYr'];
		//echo $row[0] . " - " .  $row[1] . " - " .  $row[2] . " - " .  $row[3]; 
	}//end while

	//Close DB Connection 
	mysqli_close($con);
	**************/
	
	$gp1 = '[
        {
            "GpId": 1,
            "GpNm":"বাঙ্গালপুর গ্রাম - পঞ্চায়েত"
        },
        {
            "GpId": 2,
            "GpNm": "বাগনান- ১ গ্রাম - পঞ্চায়েত"
        },
        {
            "GpId": 3,
            "GpNm": "বাগনান-২  গ্রাম - পঞ্চায়েত"
        },
        {
            "GpId": 4,
            "GpNm": "বাকসী গ্রাম - পঞ্চায়েত"
        },
        {
            "GpId": 5,
            "GpNm": "সাবসিট গ্রাম - পঞ্চায়েত"
        },
        {
            "GpId": 6,
            "GpNm": "হাটুড়িয়া-২ গ্রাম - পঞ্চায়েত"
        },
        {
            "GpId": 7,
            "GpNm": "বাইনান গ্রাম - পঞ্চায়েত"
        },
        {
            "GpId": 8,
            "GpNm": "কল্যাণপুর গ্রাম - পঞ্চায়েত"
        },
        {
            "GpId": 9,
            "GpNm": "হাটুড়িয়া -১ গ্রাম - পঞ্চায়েত" 
        },
        {
            "GpId": 10,
            "GpNm": "খালোড় গ্রাম - পঞ্চায়েত" 
        }
    ]';

	$gp = json_decode($gp1);

	$all_samsad1 = '[
		{"SsdId": "1", "SsdName": "মুর্গাবেড়িয়া বড় সাউ পাড়া", "GPId": "1"},
		{"SsdId": "2", "SsdName": "মুর্গাবেড়িয়া মেটেদের বাড়ি", "GPId": "1"},
		{"SsdId": "3", "SsdName": "মুর্গাবেড়িয়া সাগরিকা সাউ -এর বাড়ি", "GPId": "1"},
		{"SsdId": "4", "SsdName": "ওলানপাড়া শিবতলা", "GPId": "1"},
		{"SsdId": "5", "SsdName": "নাজিমা বেগম-এর বাড়ি", "GPId": "1"},
		{"SsdId": "6", "SsdName": "ওলানপাড়া মারুফাদের বাড়ি", "GPId": "1"},
		{"SsdId": "7", "SsdName": "নহোলা অনিমা প্রামাণিকের বাড়ি", "GPId": "1"},
		{"SsdId": "8", "SsdName": "মুর্গাবেড়িয়া হাজারি পাড়া", "GPId": "1"},
		{"SsdId": "9", "SsdName": "মুর্গাবেড়িয়া মল্লিক পাড়া", "GPId": "1"},
		{"SsdId": "10", "SsdName": "নহোলা বোর্ড প্রাইমারি স্কুল", "GPId": "1"},
		{"SsdId": "11", "SsdName": "বারভগবতীপুর প্রাইমারি স্কুল", "GPId": "1"},
		{"SsdId": "12", "SsdName": "বারভগবতীপুর রহিমাদের বাড়ি", "GPId": "1"},
		{"SsdId": "13", "SsdName": "মুর্গাবেড়িয়া নাসিরা বেগম বাড়ি", "GPId": "1"},
		{"SsdId": "14", "SsdName": "মুর্গাবেড়িয়া মানোয়ারা বেগম এর বাড়ি", "GPId": "1"},
		{"SsdId": "15", "SsdName": "কাজীরচক তসলিমা বেগম-এর বাড়ি", "GPId": "1"},
		{"SsdId": "16", "SsdName": "জোঁকা শিবতলা", "GPId": "1"},
		{"SsdId": "17", "SsdName": "জোঁকা বেলতলা", "GPId": "1"},
		{"SsdId": "18", "SsdName": "জোঁকা মনসা মন্দির", "GPId": "1"},
		{"SsdId": "19", "SsdName": "জোঁকা আয়মাপাড়া", "GPId": "1"},
		{"SsdId": "20", "SsdName": "জোঁকা নিমতলা", "GPId": "1"},
		{"SsdId": "21", "SsdName": "বাঙ্গালপুর উত্তরপাড়া", "GPId": "1"},
		{"SsdId": "22", "SsdName": "বাঙ্গালপুর রায়পাড়া", "GPId": "1"},
		{"SsdId": "23", "SsdName": "বাঙ্গালপুর দোলুইপাড়া", "GPId": "1"},
		{"SsdId": "24", "SsdName": "আদরা মনোরমা মান্নার বাড়ি", "GPId": "1"},
		{"SsdId": "25", "SsdName": "আদরা সরকারপাড়া", "GPId": "1"},
		{"SsdId": "26", "SsdName": "আদরা বেগম বাহারন-এর পুরাতন বাড়ি", "GPId": "1"},
		{"SsdId": "27", "SsdName": "আদরা মোল্লাপাড়া", "GPId": "1"},
		{"SsdId": "28", "SsdName": "ওলানপাড়া কেরামপাড়া", "GPId": "1"},
		{"SsdId": "29", "SsdName": "ওলানপাড়া দোলুইপাড়া", "GPId": "1"},
		{"SsdId": "30", "SsdName": "ওলানপাড়া বরখানতলা", "GPId": "1"},
		{"SsdId": "31", "SsdName": "ওলানপাড়া জলধারপাড়া", "GPId": "1"},
		{"SsdId": "32", "SsdName": "কালিকাপুর দুর্গামন্দির", "GPId": "1"},
		{"SsdId": "33", "SsdName": "বাঙ্গালপুর গঞ্জ তাঁতঘর", "GPId": "1"},
		{"SsdId": "34", "SsdName": "আদরা পাল‌পাড়া", "GPId": "1"},
		{"SsdId": "35", "SsdName": "জোঁকা বাধ", "GPId": "1"},
		{"SsdId": "36", "SsdName": "বাঙ্গালপুর বাউর বাড়ি", "GPId": "1"},
		{"SsdId": "37", "SsdName": "বাঙ্গালপুর শিবতলা", "GPId": "1"},
		{"SsdId": "38", "SsdName": "বাঙ্গালপুর  সিংহবাহিনীতলা", "GPId": "1"},
		{"SsdId": "39", "SsdName": "রথতলা নন্দীবাড়ি", "GPId": "2"},
		{"SsdId": "40", "SsdName": "এন.ডি. ব্লক দূর্গামন্দির", "GPId": "2"},
		{"SsdId": "41", "SsdName": "কাচারিপাড়া ভাইকাকুর দোকান", "GPId": "2"},
		{"SsdId": "42", "SsdName": "হিজলক পঞ্চানন্দতলা", "GPId": "2"},
		{"SsdId": "43", "SsdName": "নবাসন শীতলা মন্দির", "GPId": "2"},
		{"SsdId": "44", "SsdName": "এন.ডি ব্লক পিয়া খানদেরবাড়ি,", "GPId": "2"},
		{"SsdId": "45", "SsdName": "কপালিপাড়া শীতলামন্দির", "GPId": "2"},
		{"SsdId": "46", "SsdName": "হিজলক শীতলাতলা", "GPId": "2"},
		{"SsdId": "47", "SsdName": "টেঁপুর গোপালমন্দির", "GPId": "2"},
		{"SsdId": "48", "SsdName": "টেঁপুর শীতলা মন্দির", "GPId": "2"},
		{"SsdId": "49", "SsdName": "কাচারিপাড়া মোমেনারবাড়ি.", "GPId": "2"},
		{"SsdId": "50", "SsdName": "খাদিনান রাজাপাড়া", "GPId": "3"},
		{"SsdId": "51", "SsdName": "গোপালপুর", "GPId": "3"},
		{"SsdId": "52", "SsdName": "খাদিনান পুরাতন গড়", "GPId": "3"},
		{"SsdId": "53", "SsdName": "খাদিনান গুছাইতপাড়া", "GPId": "3"},
		{"SsdId": "54", "SsdName": "খাদিনান বিশালাক্ষীতলা", "GPId": "3"},
		{"SsdId": "55", "SsdName": "চন্দ্রপুর মাজার", "GPId": "3"},
		{"SsdId": "56", "SsdName": " চন্দ্রপুর মসজিদতলা", "GPId": "3"},
		{"SsdId": "57", "SsdName": "বেড়াবেড়িয়া শীতলাতলা", "GPId": "3"},
		{"SsdId": "58", "SsdName": "চন্দ্রপুর জয়ন্তী কর্মকারের বাড়ি", "GPId": "3"},
		{"SsdId": "59", "SsdName": "চন্দ্রপুর ফুল মালার বাড়ি", "GPId": "3"},
		{"SsdId": "60", "SsdName": " খাদিনানঘাট", "GPId": "3"},
		{"SsdId": "61", "SsdName": " খাদিনান খাঁপাড়া", "GPId": "3"},
		{"SsdId": "62", "SsdName": " খাদিনান স্কুলতলা", "GPId": "3"},
		{"SsdId": "63", "SsdName": " খাদিনান দলিজ", "GPId": "3"},
		{"SsdId": "64", "SsdName": " খাদিনান বাঁধ", "GPId": "3"},
		{"SsdId": "65", "SsdName": " খাদিনান উওরপাড়া", "GPId": "3"},
		{"SsdId": "66", "SsdName": " খাদিনান কালীমন্দির", "GPId": "3"},
		{"SsdId": "67", "SsdName": "গোপালপুর শান্তিবন", "GPId": "3"},
		{"SsdId": "68", "SsdName": " গোপালপুর গঙ্গাদেবীতলা", "GPId": "3"},
		{"SsdId": "69", "SsdName": "গোপালপুর পড়ার কালীমন্দির", "GPId": "3"},
		{"SsdId": "70", "SsdName": "গোপালপুর শীতলাতলা", "GPId": "3"},
		{"SsdId": "71", "SsdName": "মালিয়া রহিমা বেগমের বাড়ি", "GPId": "4"},
		{"SsdId": "72", "SsdName": "খাঁড়া ছিলামপুর সালেহা বেগমের বাড়ি", "GPId": "4"},
		{"SsdId": "73", "SsdName": "মানকুর নার্গিস বেগমের বাড়ি", "GPId": "4"},
		{"SsdId": "74", "SsdName": "দেউলগ্রাম বাজার", "GPId": "4"},
		{"SsdId": "75", "SsdName": "দেউলগ্রাম রঘুনাথমন্দির", "GPId": "4"},
		{"SsdId": "76", "SsdName": "দেউলগ্রাম মাহিদা বেগমের বাড়ি", "GPId": "4"},
		{"SsdId": "77", "SsdName": "ছিলামপুর", "GPId": "4"},
		{"SsdId": "78", "SsdName": "মানকুর সামন্তপাড়া", "GPId": "4"},
		{"SsdId": "79", "SsdName": "মানকুর বামুনপাড়া", "GPId": "4"},
		{"SsdId": "80", "SsdName": "বাকসী শিবতলা", "GPId": "4"},
		{"SsdId": "81", "SsdName": "বাকসী মেনকা রুইদাসের বাড়ি", "GPId": "4"},
		{"SsdId": "82", "SsdName": "ডি এম বি স্কুল", "GPId": "4"},
		{"SsdId": "83", "SsdName": "দেগ্রাম মায়াদির বাড়ি", "GPId": "4"},
		{"SsdId": "84", "SsdName": "দেগ্রাম দুর্গা মন্ডলের বাড়ি", "GPId": "4"},
		{"SsdId": "85", "SsdName": "বাগুর প্রাইমারি স্কুল", "GPId": "5"},
		{"SsdId": "86", "SsdName": "বাগুর হাঁড়াপাড়া", "GPId": "5"},
		{"SsdId": "87", "SsdName": "ব্রাহ্মণগ্রাম তাজিয়াতলা", "GPId": "5"},
		{"SsdId": "88", "SsdName": "ব্রাহ্মণগ্রাম প্রাইমারি স্কুল", "GPId": "5"},
		{"SsdId": "89", "SsdName": "মুকুন্দদিঘি শীতলাতলা", "GPId": "5"},
		{"SsdId": "90", "SsdName": "কিসমত ব্রাহ্মণগ্রাম", "GPId": "5"},
		{"SsdId": "91", "SsdName": "চাকুর প্রসাদবাটি কালীমন্দির", "GPId": "5"},
		{"SsdId": "92", "SsdName": "চাকুর সংঘশ্রী কালী মন্দির", "GPId": "5"},
		{"SsdId": "93", "SsdName": "চালিধাউরিয়া মন্দির", "GPId": "5"},
		{"SsdId": "94", "SsdName": "গদী তেঁতুলতলা", "GPId": "5"},
		{"SsdId": "95", "SsdName": "গদি পাত্রপাড়া", "GPId": "5"},
		{"SsdId": "96", "SsdName": "গদি পশ্চিমপাড়া", "GPId": "5"},
		{"SsdId": "97", "SsdName": "কাঁকটিয়া নিমতলা", "GPId": "5"},
		{"SsdId": "98", "SsdName": "পাতিনান শিবতলা", "GPId": "5"},
		{"SsdId": "99", "SsdName": "পাতিনান স্নানের ঘাট", "GPId": "5"},
		{"SsdId": "100", "SsdName": "মাসিয়ারা শিব মন্দির", "GPId": "5"},
		{"SsdId": "101", "SsdName": "কাঁকটিয়া শীতলা মন্দির", "GPId": "5"},
		{"SsdId": "102", "SsdName": " গুলামুথা মন্দির", "GPId": "5"},
		{"SsdId": "103", "SsdName": "পাঁচ পীরতলা", "GPId": "6"},
		{"SsdId": "104", "SsdName": "ব্রহ্মাতলা", "GPId": "6"},
		{"SsdId": "105", "SsdName": "হারপ শিবতলা", "GPId": "6"},
		{"SsdId": "106", "SsdName": "বেড়শেফালী মাপাড়ুর মন্দির", "GPId": "6"},
		{"SsdId": "107", "SsdName": "পূর্ণাল শীতলাতলা", "GPId": "6"},
		{"SsdId": "108", "SsdName": "পূর্ণাল কালী মন্দির", "GPId": "6"},
		{"SsdId": "109", "SsdName": "হারপ গুছাইতপাড়া", "GPId": "6"},
		{"SsdId": "110", "SsdName": "হারপ মন্ডলপাড়া", "GPId": "6"},
		{"SsdId": "111", "SsdName": "হারপ ঘোষালপাড়া স্কুল", "GPId": "6"},
		{"SsdId": "112", "SsdName": "আগুন্সী সামন্তপাড়া", "GPId": "6"},
		{"SsdId": "113", "SsdName": "আগুন্সী ধর্মরাজতলা", "GPId": "6"},
		{"SsdId": "114", "SsdName": "আগুন্সী জানাপাড়া", "GPId": "6"},
		{"SsdId": "115", "SsdName": "নওপাড়া মিদ্যেপাড়া", "GPId": "6"},
		{"SsdId": "116", "SsdName": "বেলপাড়া", "GPId": "6"},
		{"SsdId": "117", "SsdName": "শেখপাড়া", "GPId": "6"},
		{"SsdId": "118", "SsdName": "বাঁধপাড়া", "GPId": "6"},
		{"SsdId": "119", "SsdName": "বালুর জলা ", "GPId": "6"},
		{"SsdId": "120", "SsdName": " স্কুলতলা", "GPId": "6"},
		{"SsdId": "121", "SsdName": "ভূঁয়েড়া বুড়ো শিবতলা", "GPId": "6"},
		{"SsdId": "122", "SsdName": "সিংহবাহিনী মন্দির", "GPId": "7"},
		{"SsdId": "123", "SsdName": "উত্তর হাবাল", "GPId": "7"},
		{"SsdId": "124", "SsdName": "কোরিয়াচক", "GPId": "7"},
		{"SsdId": "125", "SsdName": "কোরিয়া শীতলা মন্দির", "GPId": "7"},
		{"SsdId": "126", "SsdName": "আই সি ডি এস সেন্টার মল্লিকপাড়া", "GPId": "7"},
		{"SsdId": "127", "SsdName": "সাস্টিয়া গঙ্গা মন্দির", "GPId": "7"},
		{"SsdId": "128", "SsdName": "ধর্মঘাটার বাঁধ", "GPId": "7"},
		{"SsdId": "129", "SsdName": "কোরিয়া মোল্লাপাড়া রঙ্গিলাদির বাড়ি", "GPId": "7"},
		{"SsdId": "130", "SsdName": "পূর্ব বাইনান দাসপাড়া তসলিমাদির বাড়ি", "GPId": "7"},
		{"SsdId": "131", "SsdName": "কাজীপাড়া", "GPId": "7"},
		{"SsdId": "132", "SsdName": "দক্ষিণ হাবাল", "GPId": "7"},
		{"SsdId": "133", "SsdName": "পূর্ব বাইনান সাউপাড়া", "GPId": "7"},
		{"SsdId": "134", "SsdName": "মিদ্দ্যাপাড়া", "GPId": "7"},
		{"SsdId": "135", "SsdName": "খাজুটি হাজরা পাড়া কালীতলা", "GPId": "7"},
		{"SsdId": "136", "SsdName": "খাজুটি মসজিদ", "GPId": "7"},
		{"SsdId": "137", "SsdName": "খাজুটি শিবতলা", "GPId": "7"},
		{"SsdId": "138", "SsdName": "রতনমোড় নিমতলা", "GPId": "7"},
		{"SsdId": "139", "SsdName": "খাজুটি আদক পাড়া", "GPId": "7"},
		{"SsdId": "140", "SsdName": "খাজুটি পশ্চিমপাড়া সিদ্দিকাদির বাড়ি", "GPId": "7"},
		{"SsdId": "141", "SsdName": "বাদশামোড় স্নানের ঘাট", "GPId": "7"},
		{"SsdId": "142", "SsdName": "খাজুটি বাঁধ", "GPId": "7"},
		{"SsdId": "143", "SsdName": "বাইনান রুইদাসপাড়া", "GPId": "7"},
		{"SsdId": "144", "SsdName": "বাইনান সিংহবাহিনী মন্দির", "GPId": "7"},
		{"SsdId": "145", "SsdName": "বাইনান শান্তিমোড়", "GPId": "7"},
		{"SsdId": "146", "SsdName": " বাইনান ফুলতলা", "GPId": "7"},
		{"SsdId": "147", "SsdName": "কল্যাণপুর বেরাপাড়া", "GPId": "8"},
		{"SsdId": "148", "SsdName": "কেরমানি বাজার", "GPId": "8"},
		{"SsdId": "149", "SsdName": "কামার পাড়া", "GPId": "8"},
		{"SsdId": "150", "SsdName": "নিমতলা", "GPId": "8"},
		{"SsdId": "151", "SsdName": "বিরামপুর রত্না মান্নার বাড়ী", "GPId": "8"},
		{"SsdId": "152", "SsdName": "দীপামালিতা জানাপাড়া", "GPId": "8"},
		{"SsdId": "153", "SsdName": "বটতলা", "GPId": "8"},
		{"SsdId": "154", "SsdName": "দীপামালিতা অষ্টদির বাড়ী", "GPId": "8"},
		{"SsdId": "155", "SsdName": "রাকসীট", "GPId": "8"},
		{"SsdId": "156", "SsdName": "পানিত্রাস বুড়িচন্ডীর মন্দির", "GPId": "8"},
		{"SsdId": "157", "SsdName": "শিখা মাইতির বাড়ি বরাবর", "GPId": "8"},
		{"SsdId": "158", "SsdName": "নসিবপুর আটচালা", "GPId": "8"},
		{"SsdId": "159", "SsdName": "সীমা দাসের বাড়ি", "GPId": "8"},
		{"SsdId": "160", "SsdName": "চৌধুরী পাড়া দুর্গামন্দির", "GPId": "8"},
		{"SsdId": "161", "SsdName": "তসলিমা বেগমের বাড়ি", "GPId": "8"},
		{"SsdId": "162", "SsdName": "মেমারি শীতলা মন্দির", "GPId": "9"},
		{"SsdId": "163", "SsdName": "খানপুর শিবতলা", "GPId": "9"},
		{"SsdId": "164", "SsdName": "জ্যোৎবিরেশ্বর সামন্ত পাড়া", "GPId": "9"},
		{"SsdId": "165", "SsdName": "হাটুড়িয়া দিঘির পাড়", "GPId": "9"},
		{"SsdId": "166", "SsdName": "হাটুড়িয়া শীতলা মন্দির", "GPId": "9"},
		{"SsdId": "167", "SsdName": "কাজিপাড়া", "GPId": "9"},
		{"SsdId": "168", "SsdName": "ছাতিমতলা", "GPId": "9"},
		{"SsdId": "169", "SsdName": "নতীবপুর বড়বাবা মন্দির", "GPId": "9"},
		{"SsdId": "170", "SsdName": "বাবা ক্ষেত্রপাল মন্দির ", "GPId": "9"},
		{"SsdId": "171", "SsdName": "মাজিপাড়া", "GPId": "9"},
		{"SsdId": "172", "SsdName": "হেতমপুর বাদামতলা", "GPId": "10"},
		{"SsdId": "173", "SsdName": "রিক্তা ভৌমিকের বাড়ী", "GPId": "10"},
		{"SsdId": "174", "SsdName": "দৌলুই পাড়া শীতলা মন্দির", "GPId": "10"},
		{"SsdId": "175", "SsdName": "মুরালীবাড় শীতলা মন্দির", "GPId": "10"},
		{"SsdId": "176", "SsdName": "সোনালী অধিকারীদের মন্দির", "GPId": "10"},
		{"SsdId": "177", "SsdName": "শীতলপুর আটচালা", "GPId": "10"},
		{"SsdId": "178", "SsdName": "শীতলপুর স্নানের ঘাট", "GPId": "10"},
		{"SsdId": "179", "SsdName": "মহাদেবপুর দরগাতলা", "GPId": "10"},
		{"SsdId": "180", "SsdName": "রামচন্দ্রপুর সন্তোষী মায়ের মন্দির", "GPId": "10"},
		{"SsdId": "181", "SsdName": "খালোড় খাঁড়াপাড়া মন্দির", "GPId": "10"},
		{"SsdId": "182", "SsdName": "মহাদেবপুর মসজিদতলা", "GPId": "10"},
		{"SsdId": "183", "SsdName": "রাস্তি স্নানের ঘাট", "GPId": "10"},
		{"SsdId": "184", "SsdName": "হেতমপুর পঞ্চানন্দতলা", "GPId": "10"},
		{"SsdId": "185", "SsdName": "দুর্লভপুরপঞ্চানন্দতলা", "GPId": "10"},
		{"SsdId": "186", "SsdName": "রামচন্দ্রপুর শীতলাতলা", "GPId": "10"}
		]';
	
		$all_samsad = json_decode($all_samsad1);
?>
