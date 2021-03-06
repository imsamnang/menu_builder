@extends('layouts.master')
@push('css')
  <link rel="stylesheet" href="{{asset('assets/nestable/nestable.css')}}">
@endpush

@section('content')
  <div class="row">
    <div class="col-md-8">  
      <div class="panel panel-primary">
        <div class="panel-heading">
          <button type="button" class="btn btn-default btn-sm pull-right" data-toggle="modal" data-target="#newModal"><span class="glyphicon glyphicon-plus-sign"></span>new menu item</button>
          <span><h5>Menu Builder</h5></span>
        </div>
        <div class="panel-body">
            <input type="hidden" id="id">
            <div class="cf nestable-lists">
              <div class="dd" id="nestable">
                {!!$menu!!}
              </div>
            </div>
            <p></p>
            <input type="hidden" id="nestable-output">
            <p id="success-indicator" style="display:none; margin-right: 10px;">
              <span class="glyphicon glyphicon-ok"></span> Menu order has been saved
            </p>          
        </div>
      </div>      
    </div>
    <div class="col-md-4">
      <div class="well">
        <p>Drag items to move them in a different order</p>
      </div>
    </div>
  </div>

  <!-- Create new item Modal -->
   <div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
     <div class="modal-dialog">
       <div class="modal-content">
        {!! Form::open(array('url'=>'admin/menu/new','class'=>'form-horizontal','role'=>'form')) !!}
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Provide details of the new menu item</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
                <label for="title" class="col-lg-2 control-label">Title</label>
                <div class="col-lg-10">
                  {{ Form::text('title',null,array('class'=>'form-control'))}}
                </div>
            </div>
            <div class="form-group">
                <label for="label" class="col-lg-2 control-label">Label</label>
                <div class="col-lg-10">
                  {{ Form::text('label',null,array('class'=>'form-control'))}}
                </div>
            </div>
            <div class="form-group">
                <label for="url" class="col-lg-2 control-label">URL</label>
                <div class="col-lg-10">
                  {{ Form::text('url',null,array('class'=>'form-control'))}}
                </div>
            </div>
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
           <button type="submit" class="btn btn-primary">Create</button>
         </div>
         {!! Form::close() !!}
       </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
   </div><!-- /.modal -->
  
  <!-- Delete item Modal -->
   <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
     <div class="modal-dialog">
       <div class="modal-content">
        {!! Form::open(array('url'=>'admin/menu/delete')) !!}
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Provide details of the new menu item</h4>
          </div>
          <div class="modal-body">
            <p>Are you sure you want to delete this menu item?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <input type="hidden" name="delete_id" id="postvalue" value="" />
            <input type="submit" class="btn btn-danger" value="Delete Item" />
          </div>
          {!! Form::close() !!}
       </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
   </div><!-- /.modal -->
@endsection

@push('js')
  <script src="{{ asset('assets/nestable/jquery.nestable.js') }}"></script> 
  <script type="text/javascript">
    $(function() {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $('.dd').nestable({ 
        dropCallback: function(details) {       
           var order = new Array();
           $("li[data-id='"+details.destId +"']").find('ol:first').children().each(function(index,elem) {
             order[index] = $(elem).attr('data-id');
           });
           if (order.length === 0){
            var rootOrder = new Array();
            $("#nestable > ol > li").each(function(index,elem) {
              rootOrder[index] = $(elem).attr('data-id');
            });
           }
           $.post('/admin/menu', 
            { source : details.sourceId, 
              destination: details.destId, 
              order:JSON.stringify(order),
              rootOrder:JSON.stringify(rootOrder) 
            }, 
            function(data) {
             // console.log('data '+data); 
            })
           .done(function() { 
              $( "#success-indicator" ).fadeIn(100).delay(1000).fadeOut();
           })
           .fail(function() {  })
           .always(function() {  });
         }
       });

      $('.delete_toggle').each(function(index,elem) {
          $(elem).click(function(e){
            e.preventDefault();
            $('#postvalue').attr('value',$(elem).attr('rel'));
            $('#deleteModal').modal('toggle');
          });
      });
    });
  </script>
@endpush