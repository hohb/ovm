var well={
    title:"Well Shortcode",
    id :'oscitas-form-well',
    pluginName: 'well'
};
(function() {
    _create_tinyMCE_options(well);
})();

function create_oscitas_well(pluginObj){
    if(jQuery(pluginObj.hashId).length){
        jQuery(pluginObj.hashId).remove();
    }
    // creates a form to be displayed everytime the button is clicked
    // you should achieve this using AJAX instead of direct html code like this
    var form = jQuery('<div id="'+pluginObj.id+'" class="oscitas-container" title="'+pluginObj.title+'"><table id="oscitas-table" class="form-table">\
			<tr>\
				<th><label for="oscitas-well-type">Well Type:</label></th>\
				<td><select name="type" id="oscitas-well-type">\
					<option value="">Default</option>\
					<option value="well-lg">Large</option>\
					<option value="well-sm">Small</option>\
				</select><br />\
				</td>\
			</tr>\
			<tr>\
				<th><label for="oscitas-well-content">Well Content:</label></th>\
				<td><textarea name="well" id="oscitas-well-content">Your Content</textarea><br />\
				</td>\
			</tr>\
                        <tr>\
				<th><label for="oscitas-well-class">Custom Class:</label></th>\
				<td><input type="text" name="line" id="oscitas-well-class" value=""/><br />\
				</td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="oscitas-well-submit" class="button-primary" value="Insert Well" name="submit" />\
		</p>\
		</div>');
		
    var table = form.find('table');
    form.appendTo('body').hide();
   

        
		
    // handles the click event of the submit button
    form.find('#oscitas-well-submit').click(function(){
        var cusclass='';
        if(table.find('#oscitas-well-class').val()!=''){
            cusclass= ' class="'+table.find('#oscitas-well-class').val()+'"';
        }
        var shortcode = '[well type="'+jQuery('#oscitas-well-type').val()+'"'+cusclass+']<br class="osc"/>';
        shortcode += jQuery('#oscitas-well-content').val()+'<br class="osc"/>';
        shortcode += '[/well]';

        // inserts the shortcode into the active editor
        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			
        // closes fancybox
        close_dialogue(pluginObj.hashId);
    });
}

