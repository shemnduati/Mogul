<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-header">
                        <h3 class="card-title">Delivery Status</h3>

                        <div class="card-tools">
                            <button class="btn btn-sm btn-primary"  @click="newModal">
                                Add Delivery Status
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="addnewLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" v-if="!this.editMode">Add Status</h5>
                        <h5 class="modal-title" v-if="this.editMode">Edit Status</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Status</label>
                                <input  type="text" name="status"
                                       placeholder="Enter Status"
                                       class="form-control">
                               
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success" v-if="!this.editMode">
                                Create
                            </button>
                            <button type="button" class="btn btn-success"  v-if="this.editMode">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</template>

<script>
export default {
    name: "Delivery Status",
    data() {
        return {
             deliveryStatus: '',
                editMode: '',
                form: new Form({
                    id: '',
                    status: '',
                })
        };
    },
    methods: {
         updateStatus() {
                this.form.put('api/deliveryStatus/' + this.form.id)
                    .then(() => {
                        $('#addnew').modal('hide');
                        
                    })
                    .catch(() => {

                    })
            },
            editStatus(cat) {
                this.editMode = true;
                $('#addnew').modal('show');
                this.form.fill(cat);
            },
            getStatus() {
                axios.get("/api/deliveryStatus").then(({data}) => ([this.location = data]));
            },
            addStatus() {
                this.form.post('api/deliveryStatus')
                    .then(() => {
                        $('#addnew').modal('hide');
                    })
                    .catch(error => {
                        this.errors = error.response.data.errors;
                        
                    })
            },
        newModal() {
                this.editMode = false;
                $('#addnew').modal('show');
            },
    },
};
</script>

<style scoped></style>
