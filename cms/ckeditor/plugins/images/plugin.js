var imageFn = {
  settings: {
    editors: false
  },

  init: function(editor) {
    dialog = new CKEDITOR.dialogCommand('ImageBrowser');
  },
  
  openPopup: function() {
    
  }
}

CKEDITOR.plugins.add( 'images', {
  init: function(editor) {
    CKEDITOR.dialog.add( 'ImageBrowser', function ( api )
    {
       return {
          title : 'Image Content',
          minWidth : 700,
          minHeight : 360,
          contents :
                [
                   {
                      id : 'imageProperties',
                      label : 'Properties',
                      expand : true,
                      elements :
                            [
                               {
                                  type : 'text',
                                  label: "Source",
                                  id: "imageSource",
                                  class: "inputElement"
                               },
                               {
                                  type: 'text',
                                  label: 'Link',
                                  id: 'previewImage'
                               }
                               
                            ]
                   },
                   {
                      id: 'imageBrowser',
                      label : 'Browse',
                      expand : true,
                      elements :
                            [
                               {
                                  type : 'text',
                                  label: "test"
                               }
                               
                            ]
                   },
                   {
                      id: 'imageUploader',
                      label : 'Upload',
                      expand : true,
                      elements :
                            [
                               {
                                  type : 'text',
                                  label: "test"
                               }
                               
                            ]
                   }
                ],
                buttons : [ CKEDITOR.dialog.okButton, CKEDITOR.dialog.cancelButton ],
            		onOk : function() {
                  alert('ello');  
            		},
                onCancel : function() {
                  this.destroy();
                }
       };
    });
    editor.addCommand( 'startImages' ,new CKEDITOR.dialogCommand( 'ImageBrowser' ) );
    editor.ui.addButton( 'IMGS',
    {
    	label: 'Insert Timestamp',
    	command: 'startImages',
    	icon: this.path + 'images/im.png'
    }); 
  }
});   