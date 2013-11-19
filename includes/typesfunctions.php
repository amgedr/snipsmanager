<?
//Get the code type by its ID. The variable fullName should be set to true (default) if the returned value
//will be displayed to the user and set to false if the returned value will be used to construct the name
//of GeSHi's file, e.g. Ruby on Rail's GeSHi file is rails.php so false will return 'Rails'
function ch_gettype($id, $fullName=true) {
	$id = (int)$id;
	switch($id) {
		case 1:
			return 'PHP';
			break;
		case 2:
			return 'JavaScript';
			break;
		case 3:
			return 'Text';
			break;
		case 4:
			return 'Other';
			break;
		case 5:
			return 'C++';
			break;
		case 6:
			return 'ActionScript';
			break;
		case 7:
			return 'Apache';
			break;
		case 8:
			return 'AppleScript';
			break;
		case 9:
			return 'AWK';
			break;
		case 10:
			return 'Bash';
			break;
		case 11:
			return 'C';
			break;
		case 12:
			if($fullName)
				return 'C#';
			else
				return 'CSharp';
			break;
		case 13:
			return 'CSS';
			break;
		case 14:
			return 'Delphi';
			break;
		case 15:
			return 'Fortran';
			break;
		case 16:
			return 'Haskell';
			break;
		case 17:
			return 'Java';
			break;
		case 18:
			return 'jQuery';
			break;
		case 19:
			if($fullName)
				return 'Modula-2';
			else
				return 'Modula2';
			break;
		case 20:
			return 'MySQL';
			break;
		case 21:
			return 'Perl';
			break;
		case 22:
			return 'Python';
			break;
		case 23:
			if($fullName)
				return 'Ruby on Rails';
			else
				return 'Rails';
			break;
		case 24:
			return 'Scheme';
			break;
		case 25:
			return 'SQL';
			break;
		case 26:
			if($fullName)
				return 'Visual Basic';
			else
				return 'VB';
			break;
		case 27:
			if($fullName)
				return 'Visual Basic .NET';
			else
				return 'VBNet';
			break;
		case 28:
			return 'Vim';
			break;
		case 29:
			return 'XML';
			break;
		default:
			return 'Unknown';
			break;
	}
}

//Get the ID of the code type
function ch_getTypeId($type) {
	$type = str_replace('#', 'sharp', $type);  //replace # with sharp, e.g. C# will be Csharp
	$type = str_replace('++', 'pp', $type);  //replace ++ with pp, e.g. C++ will be Cpp
	$type = str_replace('-', '', $type);  //remove -, e.g. Modula-2 will be Modula2

	$type = strtolower($type);
	switch($id) {
		case 'php':
			return 1;
			break;
		case 'javascript':
			return 2;
			break;
		case 'text':
			return 3;
			break;
		case 'other':
			return 4;
			break;
		case 'cpp':
			return 5;
			break;
		case 'actionscript':
			return 6;
			break;
		case 'apache':
			return 7;
			break;
		case 'applescript':
			return 8;
			break;
		case 'awk':
			return 9;
			break;
		case 'bash':
			return 10;
			break;
		case 'c':
			return 11;
			break;
		case 'csharp';
			return 12;
			break;
		case 'css':
			return 13;
			break;
		case 'delphi':
			return 14;
			break;
		case 'fortran':
			return 15;
			break;
		case 'haskell':
			return 16;
			break;
		case 'java':
			return 17;
			break;
		case 'jquery':
			return 18;
			break;
		case 'modula2':
			return 19;
			break;
		case 'mysql':
			return 20;
			break;
		case 'perl':
			return 21;
			break;
		case 'python':
			return 22;
			break;
		case 'ruby on rails';
		case 'rails':
			return 23;
			break;
		case 'scheme':
			return 24;
			break;
		case 'sql':
			return 25;
			break;
		case 'visual basic':
		case 'vb';
			return 26;
			break;
		case 'Visual Basic .NET':
		case 'vbnet';
			return 27;
			break;
		case 'vim':
			return 28;
			break;
		case 'xml':
			return 29;
			break;
		default:
			return 0;
			break;
	}
}

//Get the file extension of the code type
function ch_getTypeExtension($id) {
	$id = (int)$id;
	switch($id) {
		case 1:
			return '.php';
			break;
		case 2:
			return '.js';
			break;
		case 3:
			return '.txt';
			break;
		case 4:
			return '';
			break;
		case 5:
			return '.cpp';
			break;
		case 6:
			return '.as';
			break;
		case 7:
			return '';
			break;
		case 8:
			return '.scpt';
			break;
		case 9:
			return '.awk';
			break;
		case 10:
			return '';
			break;
		case 11:
			return '.c';
			break;
		case 12:
			return '.cs';
			break;
		case 13:
			return '.css';
			break;
		case 14:
			return '.pas';
			break;
		case 15:
			return '.for';
			break;
		case 16:
			return '.hs';
			break;
		case 17:
			return '.java';
			break;
		case 18:
			return '.js';
			break;
		case 19:
			return '.m2';
			break;
		case 20:
			return '.sql';
			break;
		case 21:
			return '.pl';
			break;
		case 22:
			return '.py';
			break;
		case 23:
			return '.rb';
			break;
		case 24:
			return '.scm';
			break;
		case 25:
			return '.sql';
			break;
		case 26:
			return '.vb';
			break;
		case 27:
			return '.vb';
			break;
		case 28:
			return '';
			break;
		case 29:
			return '.xml';
			break;
		default:
			return '';
			break;
	}
}
?>