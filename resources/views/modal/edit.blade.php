<div id="editModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form class="modal-content" method="POST">
            @method('PUT')
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="name">Title:</label>
                    <input id="name" class="form-control" name="name" placeholder="Title" />
                </div>
                <div class="form-group">
                    <label for="location_id">Location:</label>
                    <select id="location_id" name="location_id" class="form-control">
                        <option>- Select Location -</option>
                        @foreach(\App\Location::all() as $loc)
                            <option value="{{$loc->id}}">{{$loc->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Keywords:</label>
                    @foreach(\App\Keyword::all() as $kw)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="keywords[]" type="checkbox" id="kw-{{$kw->id}}" value="{{$kw->id}}">
                            <label class="form-check-label" for="kw-{{$kw->id}}">{{$kw->name}}</label>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success do-save">Save</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
</div>
