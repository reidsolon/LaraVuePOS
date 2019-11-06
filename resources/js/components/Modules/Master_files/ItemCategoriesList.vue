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
                            <input type="text" v-model="newCategory.itemCatCode" @keyup="validateInputs" placeholder="" class="form-control" id="itemCatCode" name="itemCatCode">
                            <div class="invalid-feedback" v-if="input.isDuplicate">
                                This code is already been taken!
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <p>Category <span class="red">*</span></p>
                            <input type="text" v-model="newCategory.itemCategory" @keyup="validateInputs" placeholder="" class="form-control" id="itemCategory" name="itemCategory">
                            <div class="invalid-feedback" v-if="isValidated == false">
                                Missing field!
                            </div>
                        </div>
                    </div>

                    <br />

                    <p>Description <span class="red">*</span></p>
                    <textarea v-model="newCategory.categoryDesc" class="form-control" @keyup="validateInputs" id="exampleFormControlTextarea1" rows="3"></textarea>
                    <div class="invalid-feedback" v-if="isValidated == false">
                       Missing field!
                    </div>
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
                        <th @click="sort('itemCatCode')" :class="isSorted.itemCatCode.type">Category Code</th>
                        <th @click="sort('itemCategory')" :class="isSorted.itemCategory.type">Category</th>
                        <th @click="sort('categoryDesc')" :class="isSorted.categoryDesc.type">Description</th>
                        <th @click="sort('status')" :class="isSorted.status.type">Status</th>
                    </tr>
                </thead>
                <tbody>
                        <category-table-item v-bind:tableRowInfo="itemCategory" v-for="itemCategory in itemCategories" :key="itemCategory.id"></category-table-item>
                </tbody>
                <tfoot>
                    
                    <!-- <pagination :data="laravelData">
                        <span slot="prev-nav">&lt; Previous</span>
                        <span slot="next-nav">Next &gt;</span>
                    </pagination> -->

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
            isSorted: {
                itemCatCode: {
                    type: ''
                },
                itemCategory: {
                    type: ''
                },
                categoryDesc: {
                    type: ''
                },
                status: {
                    type: ''
                }
            },

            input: {
                isDuplicate: false,
                hasInput: false
            },

            isDuplicate: false,
            isValidated: null,

            itemCategoriesIds: [],
            itemCategories: {},

            newCategory: {
                itemCatCode: '',
                itemCategory: '',
                categoryDesc: '',
                status: 1
            }
        }
    },
    methods: {
        // getResults(page = 1) {
		// 	axios.get('api/item-categories?page=' + page)
		// 		.then(response => {
		// 			this.itemCategories = response.data.data;
		// 		});
        // },
        
        //display data
        fetchDatas() {
            axios.get('/api/item-categories')
            .then((res) => {
                this.itemCategories = res.data.data;
                this.itemCategoriesIds = res.data.encrypted_ids;
                for(var i = 0; i<this.itemCategories.length ; i++ ){
                    this.itemCategories[i].id = this.itemCategoriesIds[i];
                }
            })
            .catch((err) => {
                console.log(err);
            })
        },

        //create category
        createData() {
            axios.post('/api/item-categories', this.newCategory)
            .then((res)=>{
                console.log(res);
                if(res.status == 201) { //if stores successfully

                    this.itemCategories.unshift(res.data);
                    this.newCategory = '';
                    this.fetchDatas();

                } else {
                    console.log('Error inserting data.');
                }
                
            })
            .catch((err)=>{
                this.input.isDuplicate = true;
            }); 
        },

        //sorts
        sort( sortField ) {  

            var sortType;
            const resetType = () => {
                this.isSorted.itemCatCode.type = '';
                this.isSorted.itemCategory.type = '';
                this.isSorted.categoryDesc.type = '';
                this.isSorted.status.type = '';
            }

            if(sortField == 'itemCatCode') {
                if( this.isSorted.itemCatCode.type == 'desc') {
                    resetType();
                    this.isSorted.itemCatCode.type = 'asc';
                   
                    sortType = 'asc';
                }else if ( this.isSorted.itemCatCode.type == 'asc' ) {
                    resetType();
                    this.isSorted.itemCatCode.type = 'desc';
                    sortType = 'desc';
                } else {
                    resetType();
                    this.isSorted.itemCatCode.type = 'desc';
                    sortType = 'desc';
                }
            }

            if(sortField == 'itemCategory') {
                if( this.isSorted.itemCategory.type == 'desc') {
                    resetType();
                    this.isSorted.itemCategory.type = 'asc';
                    sortType = 'asc';
                }else if ( this.isSorted.itemCategory.type == 'asc' ) {
                    resetType();
                    this.isSorted.itemCategory.type = 'desc';
                    sortType = 'desc';
                } else {
                    resetType();
                    this.isSorted.itemCategory.type = 'desc';
                    sortType = 'desc';
                }
            }

            if(sortField == 'categoryDesc') {
                if( this.isSorted.categoryDesc.type == 'desc') {
                    resetType();
                    this.isSorted.categoryDesc.type = 'asc';
                    sortType = 'asc';
                }else if ( this.isSorted.categoryDesc.type == 'asc' ) {
                    resetType();
                    this.isSorted.categoryDesc.type = 'desc';
                    sortType = 'desc';
                } else {
                    resetType();
                    this.isSorted.categoryDesc.type = 'desc';
                    sortType = 'desc';
                }
            }

            if(sortField == 'status') {
                if( this.isSorted.status.type == 'desc') {
                    resetType();
                    this.isSorted.status.type = 'asc';
                    sortType = 'asc';
                }else if ( this.isSorted.status.type == 'asc' ) {
                    resetType();
                    this.isSorted.status.type = 'desc';
                    sortType = 'desc';
                } else {
                    resetType();
                    this.isSorted.status.type = 'desc';
                    sortType = 'desc';
                }
            }

            axios.get('itemCategories/sort/'+sortField+"/"+sortType)
            .then((res)=>{
                this.itemCategories = res.data.data;
                this.itemCategoriesIds = res.data.encrypted_ids;
                for(var i = 0; i<this.itemCategories.length ; i++ ){
                    this.itemCategories[i].id = this.itemCategoriesIds[i];
                }
            })
            .catch((err)=>{
                this.input.isDuplicate = true;
            }); 

        },

        //validations
        validateInputs() {

            if(this.newCategory.itemCatCode != '' && this.newCategory.itemCategory != '' && this.newCategory.categoryDesc != '') {
                this.isValidated = true;
            } else {
                this.isValidated = false;
            }

        }
    },
    mounted() {
        this.fetchDatas();
        // this.getResults();
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
.table {
    border: 0.5px solid #dee2e6;
}
table tr:hover {
    cursor:pointer;
}

.desc {
    color: red;
}

.desc::after {
    content: "*";
}
.asc {
    color: blue;
}

.invalid-feedback {
    display:block;
}
</style>