@props(['url', 'modalTitle', 'modalId', 'buttonClass', 'submitButtonTitle', 'modalTriggerButton', 'buttonIconClass'])

<button type="button" class="btn {{$buttonClass}} mb-2 btn-sm" data-toggle="modal" data-target="#{{$modalId}}" style="margin-top:7px;">
@if(isset($buttonIconClass))<em class="fas {{$buttonIconClass}}"></em>@endif {{translate($modalTriggerButton)}}
</button>

<!-- Modal -->
<div class="modal fade" id="{{$modalId}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <form method="post" action="{{$url}}" enctype="multipart/form-data">
      <div class="modal-content">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="{{ $modalId }}">{{translate($modalTitle)}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          {{$body}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">{{translate('Close')}}</button>
          <button type="submit" class="btn {{$buttonClass}}">{{translate($submitButtonTitle)}}</button>
        </div>
      </div>
    </form>
  </div>
</div>
