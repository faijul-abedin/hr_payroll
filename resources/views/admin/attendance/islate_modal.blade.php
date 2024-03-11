<div class="modal fade" id="isLateStatus{{ $record->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirmation Message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to change this status?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
               
                <form action="{{ route('update.status') }}" method="POST" class="d-inline" name="update_late_status">
                    @csrf
                    <input type="hidden" name="record_id" value="{{ $record->id }}">
                    <input type="hidden" name="status_type" value="is_late">
                    <input type="hidden" name="new_status" value="{{ $record->is_late ? 0 : 1 }}">
                    <button type="submit" class="btn btn-primary">Change</button>
                </form>

            </div>
        </div>
    </div>
</div>
