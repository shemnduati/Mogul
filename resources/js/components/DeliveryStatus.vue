<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-header">
                        <h3 class="card-title">Delivery Status</h3>

                        <div class="card-tools">
                            <button
                                class="btn btn-sm btn-primary"
                                @click="newModal"
                            >
                                Delivery Status
                            </button>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#id</th>
                                <th>Status</th>
                                <th>More</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="status in deliveryStatus.data" :key="status.id">
                                <td>{{status.id}}</td>
                                 <td>{{status.status}}</td>
                                 <td>
                                    <i class="fas fa-trash" style="color: red; cursor: pointer;"></i>
                                 </td>

                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div
        class="modal fade"
        id="addnew"
        tabindex="-1"
        role="dialog"
        aria-labelledby="addnewLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-if="!this.editMode">
                        Vehicle Status
                    </h5>
                    <h5 class="modal-title" v-if="this.editMode">
                        Edit Vehicle Status
                    </h5>
                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Delivery Status</label>
                            <input
                                v-model="form.status"
                                type="text"
                                name="status"
                                placeholder="Enter Status"
                                class="form-control"
                            />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-danger"
                            data-dismiss="modal"
                        >
                            Close
                        </button>
                        <button
                            type="button"
                            class="btn btn-success"
                            v-if="!this.editMode"
                            @click="addStatus"
                        >
                            Create
                        </button>
                        <button
                            type="button"
                            class="btn btn-success"
                            v-if="this.editMode"
                            @click="editStatus"
                        >
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { Form, HasError, AlertError } from "vform";
export default {
    name: "Vehicle Status",
    data() {
        return {
            deliveryStatus:'',
            editMode: "",
            form: new Form({
                id: "",
                status: "",
            }),
        };
    },
    methods: {
        updateStatus() {
            this.form
                .put("api/deliveryStatus/" + this.form.id)
                .then(() => {
                    $("#addnew").modal("hide");
                })
                .catch(() => {});
        },
        editStatus(cat) {
            this.editMode = true;
            $("#addnew").modal("show");
            this.form.fill(cat);
        },
        getStatus() {
            axios
                .get("/api/deliveryStatus")
                .then(({ data }) => [(this.deliveryStatus = data)]);
        },
        addStatus() {
            this.form
                .post("api/deliveryStatus")
                .then(() => {
                    $("#addnew").modal("hide");
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                });
        },
        newModal() {
            this.editMode = false;
            $("#addnew").modal("show");
        },
    },
    created() {
        this.getStatus();
    },
};
</script>

<style scoped></style>
