<?php
/**
 * This displays the cutlist editor for a program
 *
 * @license     GPL
 *
 * @package     MythWeb
 * @subpackage  TV
 *
 **/

// Set the desired page title
    $page_title = 'MythWeb - '.t('Cutlist Editor').":  $program->title";

// Custom headers
    $headers[] = '<link rel="stylesheet" type="text/css" href="'.skin_url.'/tv_cutlist.css">';

// Print the page header
    require 'modules/_shared/tmpl/'.tmpl.'/header.php';
?>

<script type="text/javascript">
<!--
    function time2frame(ms, framerates) {
	for (var i = 1; i < framerates.length; i++)
	    if (ms < framerates[i].ms)
	        break;
	i--;
	return framerates[i].frame + Math.round((ms - framerates[i].ms) * framerates[i].rate / 1000000);
    }

    function frame2time(frame, framerates) {
	for (var i = 1; i < framerates.length; i++)
	    if (frame < framerates[i].frame)
	        break;
	i--;
	return framerates[i].ms + (frame - framerates[i].frame) * 1000000 / framerates[i].rate;
    }

    function updateFrames(editor, count) {
        var level = editor.levels[editor.level];
        var isms = (level.unit == 'ms');
        editor.frames = [editor.pos];
        var next = isms ? frame2time(editor.pos, editor.framerates) : editor.pos;
        var prev = next;
        for (var i = 0; i < count; i++) {
            next += level.val;
            prev -= level.val;
            var tmp = isms ? time2frame(next, editor.framerates) : next;
            editor.frames.push(tmp > editor.length ? 0 : tmp);
            tmp = isms ? time2frame(prev, editor.framerates) : prev;
            editor.frames.unshift(tmp < 1 ? 0 : tmp);
        }
    }

    function redrawNavigator(editor) {
        console.log(editor);
        for (var i = 1; i < 6; i++) {
            var img = document.getElementById('preview.'+i);
	    img.style.opacity = '0.5';
	    img.src = editor.frames[i] ? ('<?= $preview_url ?>' + editor.frames[i] + '&Width=300') : '<?= skin_img_url ?>tv.png';
	    var span = document.getElementById('frame.'+i);
	    span.innerHTML = editor.frames[i]+'<br/>'+(frame2time(editor.frames[i], editor.framerates) / 1000);
        }
    }

    function onPreviewLoaded(img) {
        img.style.opacity = '1';
    }

    function moveByStep(editor, steps) {
        if ((steps < -3) || (steps > 3))
	    return;
        editor.pos = editor.frames[3 + steps];
	updateFrames(editor, 3);
	redrawNavigator(editor);
    }

    function moveTo(editor, frame) {
        editor.pos = frame;
	updateFrames(editor, 3);
	redrawNavigator(editor);
    }

    function zoomIn(editor, left) {
        if (!editor.level)
	    return;
        editor.pos = Math.round((editor.frames[left+1] + editor.frames[left]) / 2);
	editor.level--;
	updateFrames(editor, 3);
	redrawNavigator(editor);
    }

    function zoomOut(editor, left) {
        if (editor.level == editor.levels.length - 1)
	    return;
        editor.pos = Math.round((editor.frames[left+1] + editor.frames[left]) / 2);
	editor.level++;
	updateFrames(editor, 3);
	redrawNavigator(editor);
    }

    function redrawTimeline() {
    }

    var editor = {};

    editor.framerates = [
<?php foreach ($framerates as $framerate) echo "        {frame:{$framerate['frame']},rate:{$framerate['rate']},ms:{$framerate['ms']}},\n"; ?>
    ];

    editor.length = <?= $frames ?>;
    editor.duration = frame2time(editor.length, editor.framerates);
    editor.levels = [
    	{unit:'frame',val:1},
    	{unit:'frame',val:5},
    	{unit:'ms',val:250},
    	{unit:'ms',val:500},
    	{unit:'ms',val:1000},
    	{unit:'ms',val:10000},
    	{unit:'ms',val:30000},
    	{unit:'ms',val:60000},
    	{unit:'ms',val:300000},
    	{unit:'ms',val:600000},
    ];
    editor.level = editor.levels.length - 1;
    editor.pos = 1;
    updateFrames(editor, 3);
    editor.cuts = [
<?php foreach ($cuts as $cut) echo "        {frame:{$cut['frame']},type:{$cut['type']}},\n"; ?>
    ];
// -->
</script>

<div class="navigator">
  <a onclick="moveByStep(editor,-3)">&lt;&lt;</a> <a onclick="moveByStep(editor,-1)">&lt;</a>
  <div><a onclick="zoomIn(editor,0)">+</a><br/><a onclick="zoomOut(editor,0)">-</a></div>
  <div class="frame-preview">
    <img id="preview.1" src="<?= skin_img_url ?>tv.png" width="200" onload="onPreviewLoaded(this)">
    <span id="frame.1"></span>
  </div>
  <a onclick="zoomIn(editor,1)">+</a><a onclick="zoomOut(editor,1)">-</a>
  <div class="frame-preview">
    <img id="preview.2" src="<?= skin_img_url ?>tv.png" width="200" onload="onPreviewLoaded(this)">
    <span id="frame.2"></span>
  </div>
  <a onclick="zoomIn(editor,2)">+</a><a onclick="zoomOut(editor,2)">-</a>
  <div class="frame-preview">
    <img id="preview.3" src="<?= skin_img_url ?>tv.png" width="300" onload="onPreviewLoaded(this)">
    <span id="frame.3"></span>
  </div>
  <a onclick="zoomIn(editor,3)">+</a><a onclick="zoomOut(editor,3)">-</a>
  <div class="frame-preview">
    <img id="preview.4" src="<?= skin_img_url ?>tv.png" width="200" onload="onPreviewLoaded(this)">
    <span id="frame.4"></span>
  </div>
  <a onclick="zoomIn(editor,4)">+</a><a onclick="zoomOut(editor,4)">-</a>
  <div class="frame-preview">
    <img id="preview.5" src="<?= skin_img_url ?>tv.png" width="200" onload="onPreviewLoaded(this)">
    <span id="frame.5"></span>
  </div>
  <a onclick="zoomIn(editor,5)">+</a><a onclick="zoomOut(editor,5)">-</a>
  <a onclick="moveByStep(editor,1)">&gt;</a><a onclick="moveByStep(editor,3)">&gt;&gt;</a>
</div>

<script type="text/javascript">
<!--
    redrawNavigator(editor);
// -->
</script>

<?php

// Print the page footer
    require 'modules/_shared/tmpl/'.tmpl.'/footer.php';
