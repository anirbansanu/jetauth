(function($) {
  'use strict';
  $(function() {
    var todoListItem = $('.todo-list');
    $('.todo-list-add-btn').on("click", function(event) {
      event.preventDefault();
      var cat_title = $("input[name=cat_title]").val();
      var token = $("meta[name='csrf-token']").attr("content");
      $.ajax(
        {
            url: "categories",
            type: 'POST',
            data: {
                "cat_title": cat_title,
                "_token": token,
            },
            success: function (response){
              if (cat_title) {
                todoListItem.append('<li><div class="form-check form-check-primary"><label class="form-check-label"><input class="checkbox" name="cat_title_checkbox" type="checkbox"/>'+ response.data+'<i class="input-helper"></i></label></div><i class="remove mdi mdi-close-box" data-id="'+response.id+'" ></i></li>');
                console.log(response.data);
                console.log(response.id);
              }
              console.log("Data Inserted");
              
              $("#todo-list-input").val("");
            },
            error: function(){
              console.log("Insert Oparation Failed");
            }
          
        });
        

      

    });

    todoListItem.on('change', '.checkbox', function() {
      if ($(this).attr('checked')) {
        $(this).removeAttr('checked');
      } else {
        $(this).attr('checked', 'checked');
      }

      $(this).closest("li").toggleClass('completed');

    });

    todoListItem.on('click', '.remove', function() {
      var id = $(this).data("id");
      var token = $("meta[name='csrf-token']").attr("content");
      let t = $(this).parent();
      $.ajax(
      {
          url: "delete_categories/"+id,
          type: 'GET',
          data: {
              "id": id,
              "_token": token,
          },
          success: function (){
            t.remove();
            console.log("Data Deleted");
          },
          error: function(){
            console.log("Delete Oparation Failed");
          }
        
      });
      
      
    });
    
  });
})(jQuery);