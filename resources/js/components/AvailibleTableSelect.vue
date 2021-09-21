<template>
    <div class="table-component">
        <div class="datetime-wrap">
            <div
                class="mx-auto w-1/2 flex justify-center items-center flex-wrap"
            >
                <label for="date" class="w-1/3 font-bold text-center"
                    >Date</label
                >
                <input
                    id="date"
                    type="date"
                    name="date"
                    :min="this.date_min"
                    class="w-1/2 border p-2 text-center"
                    v-model="selected_date"
                />
            </div>

            <div
                class="
                    mx-auto
                    w-1/2
                    flex
                    justify-center
                    items-center
                    flex-wrap
                    relative
                "
            >
                <label for="time" class="w-1/3 font-bold text-center"
                    >Time</label
                >
                <input
                    id="time"
                    type="time"
                    min="00:00"
                    max="23:59"
                    name="time"
                    class="w-1/2 border p-2 text-center"
                    v-model="selected_time"
                />
            </div>
        </div>
        <div class="durationWrap">
            <label>duration:</label>
            <select name="endTime" id="endTime" v-model="selected_duration">
                <option
                    v-for="value in computed_durations"
                    :key="value"
                    :value="value"
                    :default="value === duration_default ? true : false"
                >
                    {{ getDurationString(value) }}
                </option>
            </select>
        </div>

        <input type="hidden" name="table" :value="computed_tables" readonly />
        <label id="tables">
            <span class="extraDataWrap">
                <span>Tables</span>
                <span>{{ total_asigned_seats }}</span>
                <span>{{ getAvailibleSeats() }}</span>
            </span>
            <div class="custom-select-multi">
                <div
                    class="custom-option"
                    v-for="table in computed_table_data"
                    :key="table.id"
                    :value="table.id"
                    :class="isSelected(table.id) ? 'selected' : ''"
                    v-on:click="toggleTable(table.id)"
                    :id="`option-${table.id}`"
                >
                    Table {{ table.id }} - {{ table.seat_count }}
                    {{ table.seat_count > 1 ? "seats" : "seat" }}
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
        date_default: String,
        date_min: String,
        time_default: String,
        duration_default: Number,
        selectedId: String,
        tableOld: String,
    },
    data() {
        return {
            min_duration: 60,
            max_duration: 240,

            selectedTabels: [],
            selected_date: this.date_default,
            selected_time: this.time_default,
            selected_duration: 0,
        };
    },
    computed: {
        computed_old_tables: function () {
            if (this.tableOld !== "none") {
                let tables = this.tableOld?.split(",").map((i) => {
                    return parseInt(i);
                });
                this.selectedTabels = tables;
                return tables;
            } else {
                return undefined;
            }
        },
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
        computed_durations: function () {
            let durations = [];
            let cur = this.min_duration;
            do {
                durations.push(cur);
                cur += 15;
            } while (cur <= this.max_duration);
            return durations;
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
        isAvailible(table) {
            let id = table.id;
            let startDateTime = new Date(
                `${this.selected_date}T${this.selected_time}:00.000000+02:00`
            );
            let endDateTime = new Date(
                startDateTime.getTime() + this.selected_duration * 60000
            );
            let result = true;
            this.reservation_data.forEach((reservation) => {
                if (
                    startDateTime <= new Date(reservation.date_end) &&
                    endDateTime >= new Date(reservation.date_start)
                ) {
                    reservation.tables.forEach((reservedTable) => {
                        if (
                            reservedTable.id == id &&
                            reservation.id != this.selectedID
                        ) {
                            result = false;
                        }
                    });
                }
            });
            return result;
        },
        toggleTable(tableID) {
            let tables = this.selectedTabels;
            if (
                typeof tableID == "number" &&
                !this.computed_tables.split(",").includes(`${tableID}`)
            ) {
                this.selectedTabels.push(tableID);
                document
                    .getElementById(`option-${tableID}`)
                    .classList.add("selected");
            } else if (
                typeof tableID == "number" &&
                this.computed_tables.split(",").includes(`${tableID}`)
            ) {
                let indexOfTable = tables.indexOf(tableID);
                delete tables[indexOfTable];
                tables = tables.filter(function (el) {
                    return el != null;
                });
                document
                    .getElementById(`option-${tableID}`)
                    .classList.remove("selected");
                this.selectedTabels = tables;
            }
        },
        getDurationString(value) {
            let out = "+";
            if (Math.floor(value / 60) > 0) {
                out += ` ${Math.floor(value / 60)} hour`;
            }
            if (value % 60 > 0) {
                out += ` ${value % 60} minutes`;
            }
            return out;
        },
        isSelected(table) {
            return this.computed_old_tables?.includes(table);
        },
        getAvailibleSeats() {
            let seats = 0;
            let tables = this.computed_table_data ?? [];
            tables.forEach((table) => {
                seats += table?.seat_count;
            });
            if (seats < 1) {
                return "no seats availible";
            } else if (seats == 1) {
                return "1 seat availeble";
            } else {
                return `${seats} seats availible`;
            }
        },
    },
};
</script>

<style></style>
