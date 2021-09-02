<template>
    <div>
        <input type="hidden" name="table" :value="computed_tables" readonly />
        <label id="tables"
            >tables
            <select
                name="tableToAdd"
                v-model="tableToAdd"
                :value="tableToAdd"
                v-on:change="addTable()"
            >
                <option
                    v-for="table in computed_table_data"
                    :key="table.id"
                    :value="table.id"
                >
                    Table {{ table.id }} - {{ table.seat_count }}
                    {{ table.seat_count > 1 ? "seats" : "seat" }}
                </option>
            </select>
            <div class="selectedTables flex flex-row justify-start gap-2">
                <div
                    class="table"
                    v-for="(table, index) in selectedTabels"
                    :key="index"
                >
                    <p>{{ table }}</p>
                    <div class="remove" v-on:click="removeTable(index)">
                        remove
                    </div>
                </div>
            </div>
        </label>
    </div>
</template>

<script>
export default {
    props: {
        pivot: Array,
        table_data: Array,
        reservation_data: Array,

    },
    data() {
        return{
            selectedTabels: [],
            tableToAdd: "",
        }
    },
    computed: {
        computed_table_data: function () {
            return this.table_data.filter((i) => this.isAvailible(i));
        },
        computed_tables: function () {
            let out = "";
            out += this.selectedTabels?.join();
            return out;
        },
        table_seats: function () {
            let out = {};
            this.table_data.forEach((table) => {
                out[table.id] = table.seat_count;
            });
            return out;
        },
        total_asigned_seats: function () {
            let seats = 0;
            this.selectedTabels?.forEach((table) => {
                seats += this.table_seats[table];
            });
            return `total seats : ${seats}`;
        },
    },
    methods: {
        IsolateDate(datetime) {
            datetime = new Date(datetime);
            return `${datetime.getFullYear()}-${(
                "0" +
                (datetime.getMonth() + 1)
            ).slice(-2)}-${("0" + datetime.getDate()).slice(-2)}`;
        },
        IsolateTime(datetime) {
            datetime = new Date(datetime);
            return `${("0" + datetime.getHours()).slice(-2)}:${(
                "0" + datetime.getMinutes()
            ).slice(-2)}`;
        },
        removeTable(index) {
            delete this.selectedTabels[index];
            this.selectedTabels = this.selectedTabels.filter(function (el) {
                return el != null;
            });
        },
        addTable() {
            let tables = this.selectedTabels ?? [];
            if (
                typeof this.tableToAdd == "number" &&
                !this.computed_tables.split(",").includes(`${this.tableToAdd}`)
            ) {
                tables.push(this.tableToAdd);
            }
            this.tableToAdd = "";
            this.selectedTabels = tables;
        },
        isAvailible(table) {
            let id = table.id;
            let time = document.querySelector("input[id='time']")?.value;
            let date = document.querySelector("input[id='date']")?.value;
            let datetime = new Date(`${date}T${time}:00`);
            let result = true;
            this.reservation_data.forEach((reservation) => {
                if (
                    (datetime > new Date(reservation.date_start) &&
                        datetime < new Date(reservation.date_end)) ||
                    // || //uncoment when end time is configereble
                    // (
                    //     Date(`${this.current_end_date}T${this.current_end_time}`) > reservation.date_start
                    // &&
                    //     Date(`${this.current_end_date}T${this.current_end_time}`) < reservation.date_end
                    // )
                    this.selectedTabels?.includes(id)
                ) {
                    reservation.tables.forEach((rezervedTable) => {
                        if (rezervedTable.id == id) {
                            result = false;
                        }
                    });
                }
            });
            return result;
        },
    },
};
</script>

<style></style>
