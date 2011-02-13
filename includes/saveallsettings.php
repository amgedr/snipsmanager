<?php 
/**
 * Copyright (c) 2010-2011 SnipsManager (http://www.snipsmanager.com/), All Rights Reserved
 * A CodeHill Creation (http://codehill.com/)
 * 
 * IMPORTANT: 
 * - You may not redistribute, sell or otherwise share this software in whole or in part without
 *   the consent of SnipsManager's owners. Please contact the author for more information.
 * 
 * - Link to snipsmanager.com may not be removed from the software pages without permission of SnipsManager's
 *   owners. This copyright notice may not be removed from the source code in any case.
 *
 * - This file can be used, modified and distributed under the terms of the License Agreement. You
 *   may edit this file on a licensed Web site and/or for private development. You must adhere to
 *   the Source License Agreement. The latest copy can be found online at:
 * 
 *   http://www.snipsmanager.com/license/
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
 * @link        http://www.snipsmanager.com/
 * @copyright   2010-2011 CodeHill LLC (http://codehill.com/)
 * @license     http://www.snipsmanager.com/license/
 * @author      Amgad Suliman, CodeHill LLC <amgadhs@codehill.com>
 * @version     2.2
 *
 * Saves all the interface and menu settings individually. User must be logged in as admin.
 *
 */
 
session_start(); 
include('../config.php');
include('../includes/functions.php');
connect();

require('../includes/login.class.php');
$loginSys = new LoginSystem();

// if not logged in goto login form, otherwise we can view our page
if(!$loginSys->isLoggedIn()) {
	header("Location: login.php");
	exit;
}

ch_savesetting('title', $_POST['sitetitle']);
ch_savesetting('slogan', $_POST['slogan']);
ch_savesetting('logourl', $_POST['logourl']);
ch_savesetting('metadescription', $_POST['metadescription']);
ch_savesetting('metakeywords', $_POST['metakeywords']);
ch_savesetting('ownername', $_POST['ownername']);
ch_savesetting('owneremail', $_POST['owneremail']);

if(!empty($_POST['item1text']) && !empty($_POST['item1url'])) {
	ch_savesetting('topmenu1text', $_POST['item1text']);
	ch_savesetting('topmenu1url', $_POST['item1url']);
}
else {
	ch_savesetting('topmenu1text', '');
	ch_savesetting('topmenu1url', '');
}

if(!empty($_POST['item2text']) && !empty($_POST['item2url'])) {
	ch_savesetting('topmenu2text', $_POST['item2text']);
	ch_savesetting('topmenu2url', $_POST['item2url']);
}
else {
	ch_savesetting('topmenu2text', '');
	ch_savesetting('topmenu2url', '');
}

if(!empty($_POST['item3text']) && !empty($_POST['item3url'])) {
	ch_savesetting('topmenu3text', $_POST['item3text']);
	ch_savesetting('topmenu3url', $_POST['item3url']);
}
else {
	ch_savesetting('topmenu3text', '');
	ch_savesetting('topmenu3url', '');
}

if(!empty($_POST['item4text']) && !empty($_POST['item4url'])) {
	ch_savesetting('topmenu4text', $_POST['item4text']);
	ch_savesetting('topmenu4url', $_POST['item4url']);
}
else {
	ch_savesetting('topmenu4text', '');
	ch_savesetting('topmenu4url', '');
}

ch_savesetting('iconset', $_POST['sbfolders']);	

?>