<?php
/*
 * message.php
 * 
 * Copyright (c) 2012 Andrew Jordan
 * 
 * Permission is hereby granted, free of charge, to any person obtaining 
 * a copy of this software and associated documentation files (the 
 * "Software"), to deal in the Software without restriction, including 
 * without limitation the rights to use, copy, modify, merge, publish, 
 * distribute, sublicense, and/or sell copies of the Software, and to 
 * permit persons to whom the Software is furnished to do so, subject to 
 * the following conditions:
 *
 * The above copyright notice and this permission notice shall be 
 * included in all copies or substantial portions of the Software. 
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, 
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF 
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. 
 * IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY 
 * CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, 
 * TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE 
 * SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */
require("includes/init.php");
require("includes/Message.class.php");
if($auth=TRUE){
	if(is_numeric(@$_GET['id']) && is_numeric(@$_GET['topic'])){
		if(is_numeric(@$_GET['r']))
			$revision_no = intval($_GET['r']);
		else
			$revision_no = 0;
		$message_id = intval($_GET['id']);
		$topic_id = intval($_GET['topic']);
		$message = new MessageRevision($db, $message_id, $revision_no);
		if($message->doesExist()){
			$smarty->assign("message", override\formatComments(override\makeURL(override\closeTags(
													str_replace("\n", "<br/>", 
														override\htmlentities($message->getMessage(), $allowed_tags))))));
			$smarty->assign("posted", $message->getPosted());
			$smarty->assign("revision_history", $message->getRevisions());
			$smarty->assign("topic_title", override\htmlentities($message->getTopicTitle()));
			$smarty->assign("board_title", override\htmlentities($message->getBoardTitle()));
			$smarty->assign("topic_id", $topic_id);
			$smarty->assign("board_id", $message->getBoardID());
			$smarty->assign("revision_no", $message->getRevisionID());
			$smarty->assign("message_id", $message_id);
			$smarty->assign("m_user_id", $message->getUserID());
			$smarty->assign("m_username", $message->getUsername());
			$display = "message.tpl";
			require("includes/deinit.php");
		}else
			require("404.php");
	}else
		require("404.php");
	
}else
	require("404.php");

?>