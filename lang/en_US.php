<?php
$lang['friendlyname'] = 'Social Video Player';
$lang['postinstall'] = 'Post Install Message.';
$lang['postuninstall'] = 'Post Uninstall Message, e.g., "Curses! Foiled Again!"';
$lang['really_uninstall'] = 'Really? Are you sure
you want to unsinstall this fine module?';
$lang['uninstalled'] = 'Module Uninstalled.';
$lang['installed'] = 'Module version %s installed.';
$lang['upgraded'] = 'Module upgraded to version %s.';
$lang['moddescription'] = 'Give the module a YouTube, Vimeo or DailyMotion url and it will give you back a player or thumbnail with desired sizes.';

$lang['error'] = 'Error!';
$land['admin_title'] = 'Social Video Player Admin Panel';
$lang['admindescription'] = 'SVP preferences';
$lang['accessdenied'] = 'Access Denied. Please check your permissions.';
$lang['postinstall'] = 'Post Install Message, (e.g., Be sure to set "" permissions to use this module!)';


$lang['changelog'] = '<ul>
<li>Version 0.0.1 - 16 August 2010. Initial Release.</li>
</ul>';
$lang['help'] = '<h3>What Does This Do?</h3>
<p>Give the module a YouTube, Vimeo or DailyMotion url and it will give you back a player or thumbnail with desired sizes.</p>
<h3>How Do I Use It</h3>
<p>To show a video, just use {SVP url="http://url_of_my_video/"}. You can add height and width to change the size of the video.</p>
<p>To show a thumbnail of the video, you can use {SVP action="thumbnail" url="http://url_of_my_video/"}. You can also play with height and width (only for Vimeo).</p>
<p>{SVP action="embed" url="http://url_of_my_video/"} returns the embed url (YT only)</p>
<h3>What Parameters Does It Take</h3>
<ul>
	<li><strong>url</strong> (mandatory): The url of your video.</li>
	<li><strong>width</strong>: Desired width.</li>
	<li><strong>height</strong>: Desired height.</li>
	<li><strong>wmode</strong>: Flash wmode param (default: opaque).</li>
	<li><strong>version</strong>: Version (filename) for the thumbnail (default YT: hqdefault.jpg).</li>
</ul>
<h3>Support</h3>
<p>As per the GPL, this software is provided as-is. Please read the text of the license for the full disclaimer.</p>
<h3>Copyright and License</h3>
<p>Copyright &copy; 2010, Jean-Christophe Cuvelier <a href="mailto:jcc@morris-chapman.com">&lt;jcc@morris-chapman.com&gt;</a>. All Rights Are Reserved.</p>
<p>This module has been released under the <a href="http://www.gnu.org/licenses/licenses.html#GPL">GNU Public License</a>. You must agree to this license before using the module.</p>';
?>
