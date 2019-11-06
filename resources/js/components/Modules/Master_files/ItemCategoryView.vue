<template>
    
    <div class="container">
        <div class="row ">
            <div id="category_container" class="col-md-12 col-lg-12 col-sm-12">
                <div class="row">
                    <div id="category_header" class="col-md-12 col-lg-12 col-sm-12">
                        <div class="row">

                            <div class="col-md-6 col-lg-6">
                                View Category
                            </div>

                            <div class="col-md-6 col-lg-6">
                                <div class="row justify-content-end" v-if="category_info[0].status == 1">
                                    <button class="btn btn-warning" @click="editLink">Edit</button>   
                                    &nbsp;
                                    <button class="btn btn-danger">Delete</button>
                                    &nbsp;&nbsp;   
                                </div>
                            </div>

                        </div>
                    </div>
                    <div id="category_body" class="col-md-12 col-lg-12 col-sm-12">
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                            
                                <div class="row">
                                    <div class="col-md-4 col-lg-4 view-label">
                                    <strong>Category Code</strong>
                                    </div>
                                    <div class="col-md-4 col-lg-4 view-input">
                                        {{category_info[0].itemCatCode}}
                                    </div>  
                                </div>
                                <br />
                                <div class="row">
                                    <div class="col-md-4 col-lg-4 view-label">
                                    <strong>Category</strong>
                                    </div>
                                    <div class="col-md-4 col-lg-4 view-input">
                                        {{category_info[0].itemCategory}}
                                    </div>  
                                </div>

                            </div>
                            <div class="col-md-6 col-lg-6 ">
                                <div class="row">
                                    <div class="col-md-4 col-lg-4 view-label">
                                    <strong>Description</strong>
                                    </div>
                                    <div class="col-md-4 col-lg-4 view-input">
                                        {{category_info[0].categoryDesc}}
                                    </div>  
                                </div>
                                <br />
                               
                            </div>
                        </div>

                    </div>
                    <div id="category_footer">
                        Date Created: {{ category_info[0].created_at | moment('D, MMM YYYY') }} <br>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    
</template>

<script>
export default {

    props: {
        category_info: Array
    },
    data() {
        return {
            encrypted_id: String
        }
    },
    methods: {
       getEncryptedId() {
           axios.get('http://localhost:8000/itemCategories/encrypt/'+this.category_info[0].id)
           .then((res) => {
               this.encrypted_id = res.data;
           })
           .catch((err) => {
               console.log(err);
           })
       },
       editLink() {
            window.location.href = "http://localhost:8000/itemCategories/edit/"+this.encrypted_id;
       }
    },
    mounted() {
        this.getEncryptedId();        
    }
    
}
</script>

<style scoped>
#category_container{
    border: 0.5px solid #f0f0f0;
    border-radius: 5px;
    background-color: #fff;
}
#category_header{
    padding: 15px;
    border-bottom: 0.5px solid #f0f0f0;
}

#category_footer{
    padding: 15px;
}

#category_body {
    padding: 15px;
}

.view-input {
    border-bottom: 0.5px solid #f0f0f0;
}
</style>