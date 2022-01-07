<div class="modal fade" id="newSliders" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Section</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-2">
                    <input type="hidden" ref="sectionId">
                    <label for="email">Name</label>
                    <input type="text" ref="name" class="form-control" >
                </div>
                <div class="form-check">
                    <input type="checkbox" ref="active" class="form-check-input" id="check1" name="option1" value="something" checked>
                    <label class="form-check-label" for="check1">Active</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" ref="deleteSection" class="btn btn-danger d-none">
                    delete
                </button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" ref="saveSection" class="btn btn-primary">
                    Save
                </button>
            </div>
        </div>
    </div>
</div>
