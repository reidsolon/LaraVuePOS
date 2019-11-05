<template>

         <tr :key="tableRowInfo.id" @click="redirect">
            
                <td scope="row">&nbsp;</td>
                <td scope="row"><p>{{ tableRowInfo.itemCatCode }}</p></td>
                <td scope="row">{{ tableRowInfo.itemCategory }}</td>
                <td scope="row">{{ tableRowInfo.categoryDesc }}</td>
                <td scope="row">   
                    <span v-if="tableRowInfo.status == 1">
                        <span class="badge badge-pill badge-success" style="padding-left: 15px; padding-right: 15px;">Active</span>
                    </span>

                    <span v-else>
                        <span class="badge badge-pill badge-danger">Inactive</span>
                    </span>
                </td>
            
        </tr>
    
</template>

<script>
export default {

    props: {
        count: Number,
        tableRowInfo: Object
    },
    data() {
        return {
        }
    },
    methods: {
        redirect() {
            window.location.href = "/itemCategories/"+this.tableRowInfo.id;
        }
    }
    
}
</script>

<style scoped>
.badge {
    padding: 10px;
}
</style>