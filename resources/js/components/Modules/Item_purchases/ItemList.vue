<template>
    <div class="container">
        <div class="row" id="table_actions">
            <div class="col-md-4 col-lg-4 col-sm-12">
                <h3><strong>Item List</strong></h3>
            </div>
            <div class="col-md-4 col-lg-4 col-sm-12">
        
            </div>
            <div class="col-md-4 col-lg-4 col-sm-12">
                <div class="row justify-content-end">
                    <div class="col-md-5 col-lg-5">
                        <button class="btn btn-primary" style='width: 100%;' data-toggle="modal" data-target="#addItemModal">Add Item</button>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="row">&nbsp;</th>
                        <th>Category</th>
                        <th>Item Code</th>
                        <th>Item</th>
                        <th>Description</th>
                        <th>Last Cost</th>
                        <th>Ave Price</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <item-list-item></item-list-item>
                </tbody>
                </table>
            </div>
        </div>
        
    </div>
</template>

<script>
export default {
    
}
</script>

<style scoped>
#table_actions {
    margin-bottom: 2%;
}
</style>