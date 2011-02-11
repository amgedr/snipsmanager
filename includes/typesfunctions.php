<?
/**
 * Copyright (c) 2010-2011 CodeHave (http://www.codehave.com/), All Rights Reserved
 * A CodeHill Creation (http://codehill.com/)
 * 
 * IMPORTANT: 
 * - You may not redistribute, sell or otherwise share this software in whole or in part without
 *   the consent of CodeHave's owners. Please contact the author for more information.
 * 
 * - Link to codehave.com may not be removed from the software pages without permission of CodeHave's
 *   owners. This copyright notice may not be removed from the source code in any case.
 *
 * - This file can be used, modified and distributed under the terms of the License Agreement. You
 *   may edit this file on a licensed Web site and/or for private development. You must adhere to
 *   the Source License Agreement. The latest copy can be found online at:
 * 
 *   http://www.codehave.com/license/
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR 
 * IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND 
 * FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR 
 * CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
 * DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, 
 * WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY
 * WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * @link        http://www.codehave.com/
 * @copyright   2010-2011 CodeHill LLC (http://codehill.com/)
 * @license     http://www.codehave.com/license/
 * @author      Amgad Suliman, CodeHill LLC <amgadhs@codehill.com>
 * @version     2.2
 *
 * A group of syntax highlighting functions.
 *
 */
 
 
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