<template>
    <div>
        <v-app id="inspire">
            <v-data-table
                :headers="headers"
                :items="data"
                item-key="department_name.id"
                class="elevation-1"
                :search="search"
                :items-per-page="10"
                :footer-props="{
                    showFirstLastPage: true,
                    firstIcon: 'mdi-arrow-collapse-left',
                    lastIcon: 'mdi-arrow-collapse-right',
                    prevIcon: 'mdi-minus',
                    nextIcon: 'mdi-plus',
                }"
            >
                <template v-slot:item.controls="props">
                    <div style="display: inline-flex; align-items: center">
                        <!-- <v-btn class="mx-2" fab dark x-small>
                            <v-icon dark @click="onButtonClick(props.item.id)"
                                >mdi-eye</v-icon
                            >
                        </v-btn> -->
                        <a
                            :href="route + '/' + props.item.id + '/edit/'"
                            class="mx-2"
                            fab
                            dark
                            x-small
                        >
                            <v-btn class="mx-2" fab dark x-small>
                                <v-icon dark>mdi-pencil</v-icon>
                            </v-btn>
                        </a>
                        <v-row justify="center">
                            <v-dialog
                                v-model="dialog"
                                persistent
                                max-width="290"
                            >
                                <template v-slot:activator="{ on, attrs }">
                                    <v-btn
                                        class="mx-2"
                                        fab
                                        dark
                                        x-small
                                        v-bind="attrs"
                                        v-on="on"
                                    >
                                        <v-icon dark>mdi-delete</v-icon>
                                    </v-btn>
                                </template>
                                <v-card>
                                    <v-card-title class="text-h5">
                                    </v-card-title>
                                    <v-card-text
                                        >Do you want to delete this record?
                                    </v-card-text>
                                    <v-card-actions>
                                        <v-spacer></v-spacer>
                                        <v-btn
                                            color="green darken-1"
                                            text
                                            @click="
                                                onButtonClick(props.item.id)
                                            "
                                        >
                                            Yes
                                        </v-btn>
                                        <v-btn
                                            color="green darken-1"
                                            text
                                            @click="dialog = false"
                                        >
                                            Cancel
                                        </v-btn>
                                    </v-card-actions>
                                </v-card>
                            </v-dialog>
                        </v-row>
                    </div>
                </template>
                <template v-slot:top>
                    <v-text-field
                        v-model="search"
                        label="Search..."
                        class="mx-4"
                    ></v-text-field>
                </template>
            </v-data-table>
        </v-app>
        <!-- <Editor /> -->
    </div>
</template>
<script>
export default {
    props: {
        route: { type: String, required: false },
    },
    data() {
        return {
            dialog: false,
            editor: null,
            search: "",
            headers: [
                { text: "id", value: "purchase_requests.id", align: " d-none" },
                { text: "Request by", value: "name" },
                { text: "Title", value: "title" },
                { text: "Author", value: "author_name" },
                { text: "Edition", value: "edition" },
                { text: "Created Date", value: "created_at" },
                { text: "Action", value: "controls", sortable: false },
            ],
            data: [
                {
                    id: 0,
                    name:"",
                    title:"",
                    author_name:"",
                    edition:"",
                    created_at: "",
                },
            ],
        };
    },
    mounted() {
        axios
            .get(base_url + "/purchase_requests/data")
            .then((response) => (this.data = response.data.data));
    },
    methods: {
        onButtonClick(id) {
            window.location.href = base_url + "/purchase_requests/delete/" + id;
        },
    },
};
</script>
