{if isset($doctable)}
<button type="button" class="form-control btn btn-danger" onclick="openelement('newdoc' );">{'Create a new document'|gettext}</button>                    

<table class="table" id="doctable">
    <thead>
        <tr>
            <th>{'DocID'|gettext}</th><th>{'Doc-Section'|gettext}</th><th>{'Doc-Topic'|gettext}</th><th>{'Doc'|gettext}</th><th>{'Further Reads'|gettext}</th><th>{'Work'|gettext}</th>
        </tr>
    </thead>
    {foreach $doctable as $key => $doc}
        <tr>
            <td>{$doc.id}</td>
            <td>{$doc.section}</td>
            <td>{$doc.topic}</td>
            <td>{$doc.desc|truncate:40}</td>
            <td>{$doc.further|truncate:40}</td>
            <td>
                <button type="button" class="form-control btn btn-success" onclick="openelement('docid_{$doc.id}' );">{'Open Documentation table'|gettext}</button>                    
            </td>        
        </tr>
    {/foreach}
</table>

<script type="text/javascript">
$(document).ready( function () {
    $('#doctable').DataTable();
} );
</script>

{/if}
{if isset($showform)}

<h1>INPUT FORM</h1>



{$selset = ""}
{if (isset($doc.section))}{$selset = $doc.section}{/if}
<input type="hidden" id="id" value="{$doc.id|default:"-1"}"/>
<label for="section">Section for this topis</label>
<table><tr><td width="95%">

{html_options id="section" name="section" options=$docsecs output=label selected=$selset class="form-control"}

</td><td>
<button type="button" class="form-control btn btn-success" title="{'Add a new section'|gettext}" onclick="openelement('addsection');"><strong>+</strong></button>

</td></tr></table>
<label for="topic">{'Topic'|gettext}</label>
<input type="text" id="topic" class="form-control" placeholder="{'Topic'|gettext}" value="{$doc.topic|default:""}"required="required"/>
<label for="editor">Content</label>
<!--------------------editor----------------->
<div id="editor" contenteditable="true">
      {$doc.desc|default:"kein inhalt"}
</div>
<!--------------------editor----------------->
<label for="topic">{'Further (keywords...)'|gettext}</label>
<input type="text" id="further" class="form-control" placeholder="{'Further (keywords...)'|gettext}" value="{$doc.topic|default:''}" required="required"/>
<br />
<button type="button" class="form-control btn btn-success"  title="Save this docu" onclick="savedoc();"><strong>{'Save'|gettext}</strong></button>
<button type="button" class="form-control btn btn-warning" onclick="openelement('doctable');">{'Cancel'|gettext}</button>





<script type="text/javascript">
    $(document).ready( function () {   
        $('#editor').summernote();
    } );
</script>   

{/if}

{if isset($shownewsecform)}
    {$selset = ""}
    {if (isset($section.parentid))}{$selset = $section.parentid}{/if}
    <form method="post">
    <label for="parentid">{'Parent'|gettext}</label>
    {html_options id="parentid" name="parentid" options=$docsecs output=label selected=$selset class="form-control"}
    <label for="sectionlabel">{'Section Name'|gettext}</label>
    <input type="text" class="form-control" id="sectionlabel" placeholder="{'Add the section label here (keep it short)'|gettext}" required="required"/>
    <label for="sectiondesc">{'Section (short) description'|gettext}</label>
    <input type="text" class="form-control" id="sectiondesc" placeholder="{'Add the section description here (keep it short)'|gettext}" required="required"/>
    <button type="button" class="form-control btn btn-success"  title="{'Add a new section'|gettext}" onclick="addsection();"><strong>+</strong></button>
    </form>

{/if}


