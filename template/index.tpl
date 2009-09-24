<div class="form-container">

<p>PDF2up transforms a single-page PDF document into a document with two journal-style pages side by side. It tries to intelligently resize the original document in order to use the maximum space available and to reduce whitespace.</p>

<form action="index.php" method="post" enctype="multipart/form-data" >
<input type="hidden" name="MAX_FILE_SIZE" value="20000000" />

<fieldset>
    <legend>File upload</legend>
        <div><label for="file">PDF File</label> <input id="file" type="file" name="file" value="" />
            <p class="note">Maximum upload size allowed: 20MB.</p>
  </div>
  <div> <label for="pages">Include pages</label>
  <input name="pages" type="radio" value="all" checked="checked" />all &nbsp; 
  <input name="pages" type="radio" value="skipfirst" />skip first &nbsp; 
  <input name="pages" type="radio" value="list" />list of pages (e.g. 1-2,5-end)
  <input name="plist" type="text" value="" /> 
  </div> 
  <div> <label for="format">Paper format</label>
  <input name="format" type="radio" value="a4" checked="checked" />A4 &nbsp; 
  <input name="format" type="radio" value="letter" />letter
  </div> 
</fieldset>

<div class="buttonrow">
    <input type="submit" value="Upload" class="button" />
</div>

</form>

</div><!-- /form-container -->
