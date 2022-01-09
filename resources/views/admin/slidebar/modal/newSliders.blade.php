<div class="modal fade" id="newSliders" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New slider image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-2 mt-2">
                    <input type="hidden" ref="sliderId">
                    <label for="name">Image</label>
                    <input type="file" id="name" ref="img" class="form-control mt-2" >
                    <div ref="editImageResult"></div>
                </div>
                <div class="form-group mb-2 mt-2">
                    <label for="title">Title</label>
                    <input type="text" id="title" ref="title" class="form-control mt-2" >
                </div>

                <div class="form-group mb-2 mt-2">
                    <label for="desc">Description</label>
                    <textarea id="desc" ref="desc" class="form-control mt-2" rows="6" cols="6"></textarea>
                </div>
                <div class="form-check">
                    <input type="checkbox" ref="active" class="form-check-input" id="check1" name="option1" value="something" checked>
                    <label class="form-check-label" for="check1">Active</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" ref="deleteSlider" class="btn btn-danger d-none">
                    delete
                </button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" ref="saveSlider" class="btn btn-primary">
                    Save
                </button>
            </div>
        </div>
    </div>
</div>
