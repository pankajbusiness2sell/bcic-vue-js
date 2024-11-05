@include('layout.header')
<div id="app">
    @if((!empty($pagename) && $pagename == 'sales') ||  (!empty($action) && $action == 'sales-task'))
      <task-share-report></task-share-report>  
      @elseif((!empty($pagename) && $pagename == 'hr') ||  (!empty($action) && $action == 'hr-task'))
         <hr-share-task></hr-share-task>  
      @elseif((!empty($pagename) && $pagename == 'review') ||  (!empty($action) && $action == 'review-task'))
         <review-share-task></review-share-task>  
      @elseif((!empty($pagename) && $pagename == 'reclean') ||  (!empty($action) && $action == 'reclean-task'))
         <reclean-share-task></reclean-share-task>  
      @elseif((!empty($pagename) && $pagename == 'complaint') ||  (!empty($action) && $action == 'complaint-task'))
         <complaint-share-task></complaint-share-task>  
      @elseif((!empty($pagename) && $pagename == 'custome') ||  (!empty($action) && $action == 'custome-task'))
        <custome-share-task></custome-share-task>  
    @else
      <task-share-report></task-share-report>  
    @endif
</div>    
@include('layout.footer')          