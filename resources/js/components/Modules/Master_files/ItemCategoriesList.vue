<template>
    <div class="container">

        <div class="modal fade" id="addItemCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <p>Category Code <span class="red">*</span></p>
                            <input type="text" v-model="itemCategory.itemCatCode" @keyup="validateInputs" placeholder="" class="form-control" id="itemCatCode" name="itemCatCode">
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <p>Category <span class="red">*</span></p>
                            <input type="text" v-model="itemCategory.itemCategory" @keyup="validateInputs" placeholder="" class="form-control" id="itemCategory" name="itemCategory">
                        </div>
                    </div>

                    <br />

                    <p>Description <span class="red">*</span></p>
                    <textarea v-model="itemCategory.categoryDesc" class="form-control" @keyup="validateInputs" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <div class="loadingBar"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    <span v-if="isValidated == true">
                        <button type="button" class="btn btn-primary" id="add-category-btn" @click="createData" @keydown.enter="createData">Save Category</button>
                    </span>

                    <span v-else>
                        <button disabled type="button" class="btn btn-primary" id="add-category-btn" @click="createData" @keydown.enter="createData">Save Category</button>
                    </span>
                    
                </div>
                </div>
            </div>
        </div>

        <div class="row" id="table_actions">
            <div class="col-md-4 col-lg-4 col-sm-12">
                <h3><strong>Item Categories List</strong></h3>
            </div>
            <div class="col-md-4 col-lg-4 col-sm-12">
        
            </div>
            <div class="col-md-4 col-lg-4 col-sm-12">
                <div class="row justify-content-end">
                    <div class="col-md-5 col-lg-5">
                        <button class="btn btn-primary" style='width: 100%;' data-toggle="modal" data-target="#addItemCategory" >Add Category</button>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <table class="table table-striped" style="width: 100%;">
                <thead>
                    <tr>
                        <th scope="row">&nbsp;</th>
                        <th>Category Code</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody v-for="itemCategory in itemCategories" :key="itemCategory.id">
                    <category-table-item v-bind:tableRowInfo="itemCategory"></category-table-item>
                </tbody>
                <tfoot>
                    
                </tfoot>
                </table>
            </div>
        </div>
        
    </div>
</template>

<script>
    
export default {
    
    data () {
        return {
            isValidated: false,
            itemCategoriesIds: [],
            itemCategories: [],
            itemCategory: {
                itemCatCode: '',
                itemCategory: '',
                categoryDesc: '',
                status: 1
            }
        }
    },
    methods: {
        fetchDatas() {
            axios.get('/api/item-categories')
            .then((res) => {
                this.itemCategories = res.data.data;
                this.itemCategoriesIds = res.data.encrypted_ids;
                for(var i = 0; i<this.itemCategories.length ; i++ ){
                    this.itemCategories[i].id = this.itemCategoriesIds[i];
                }
                console.log(res);
            })
            .catch((err) => {
                console.log(err);
            })
        },
        createData() {
            axios.post('/api/item-categories', this.itemCategory)
            .then((res)=>{
                this.itemCategories.unshift(res.data);
                this.itemCategory = '';
                this.fetchDatas();
            })
            .catch((err)=>{
                console.log(err);
            });
        },

        //validations
        validateInputs() {

            if(this.itemCategory.itemCatCode != '' && this.itemCategory.itemCategory != '' && this.itemCategory.categoryDesc != '') {
                this.isValidated = true;
            } else {
                this.isValidated = false;
            }

        }
    },
    mounted() {
        this.fetchDatas();
    }
}
</script>

<style scoped>
#table_actions {
    margin-bottom: 2%;
}

.red {
    color: red;
}
.loadingBar {
    background-color:red;
    height: 2.5px;
    width: 100%;
}
table tr:hover {
    cursor:pointer;
}
</style>