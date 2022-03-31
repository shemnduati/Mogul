<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-header">
                        <h3 class="card-title">Delivery</h3>

                        <div class="card-tools">
                            <button class="btn btn-sm btn-primary" @click="newModal">
                                Add Delivery
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
                        <h5 class="modal-title" v-if="!this.editMode">Add Station Location</h5>
                        <h5 class="modal-title" v-if="this.editMode">Edit Location</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form>
                        <div class="modal-body">
                        <div class="form-group">
                                        <label for="level">Select An Order</label>
                                        <select v-model="form.status" class="form-control" name="status" id="status">
                                            <option selected value="">--Select Order--</option>
                                            <option  v-for="order in orders.data" :key="order.id" :value="order.id">{{ order.title}}</option>
                                        </select>
                            </div>
                            <div class="form-group">
                                        <label for="level">Delivery Status</label>
                                        <select v-model="form.status" class="form-control" name="status" id="status">
                                            <option selected value="">--Select Stauts--</option>
                                            <option value="1">Mombasa</option>
                                            <option value="2">Nairobi</option>
                                        </select>
                            </div>
                            <div class="form-group">
                                        <label for="level">Select Delivery Vehicle</label>
                                        <select v-model="form.status" class="form-control" name="status" id="status">
                                            <option selected value="">--Select Stauts--</option>
                                            <option value="1">Mombasa</option>
                                            <option value="2">Nairobi</option>
                                        </select>
                            </div>
                            <div class="form-group">
                                        <label for="level">Select Destination</label>
                                        <select v-model="form.status" class="form-control" name="status" id="status">
                                            <option selected value="">--Select Stauts--</option>
                                            <option value="1">Mombasa</option>
                                            <option value="2">Nairobi</option>
                                        </select>
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
                    </div>
                    </form>
                </div>
            </div>
        </div>
</template>

<script>
import { Form, HasError, AlertError } from 'vform';
export default {
    name: "Delivery",
    data() {
        return {
            vehicles:'',
            orders:'',
            location:'',
            editMode: "",
            form: new Form({
                id: "",
                orderId: "",
                deliveryStatus: "",
                vehicleId: "",
                locationId: "",
            }),
        };
    },
    methods: {
   updateDelivery() {
            this.form
                .put("api/delivery/" + this.form.id)
                .then(() => {
                    $("#addnew").modal("hide");
                })
                .catch(() => {});
        },
        editVehicle(del) {
            this.editMode = true;
            $("#addnew").modal("show");
            this.form.fill(del);
        },
        getVehicle() {
            axios
                .get("/api/vehicle")
                .then(({ data }) => [(this.vehicles = data['parent'])]);
        },
        getLocation() {
            axios
                .get("/api/location")
                .then(({ data }) => [(this.location = data)]);
        },
         getOrders() {
            axios
                .get("/api/orders")
                .then(({ data }) => [(this.orders = data)]);
        },
        addDelivery() {
            this.form
                .post("api/delivery")
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
        this.getOrders();
        this.getLocation();
        this.getVehicle();
    },
};
</script>

<style scoped></style>
