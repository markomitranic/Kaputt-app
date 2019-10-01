<template>
    <div id="date-range">
        <datepicker @input="startDateChangeListener" :placeholder="pickDateLabel"></datepicker>
        <p class="error" v-bind:class="{ disabled: !startDateErrorMessage }">{{startDateErrorMessage}}</p>
        <datepicker @input="endDateChangeListener" :placeholder="pickDateLabel"></datepicker>
        <p class="error" v-bind:class="{ disabled: !endDateErrorMessage }">{{startDateErrorMessage}}</p>
    </div>
</template>

<script>
    import Datepicker from 'vuejs-datepicker';
    import moment from "moment";

    export default {
        name: 'DateRange',
        components: {
            Datepicker
        },
        data() {
            return {
                pickDateLabel: 'Pick a date...',
                startDate: null,
                startDateErrorMessage: null,
                endDate: null,
                endDateErrorMessage: null,
            }
        },
        computed: {
            dateRange: function() {
                return this.startDate + '_' + this.endDate; // 2019-09-20_2019-09-20
            }
        },
        watch: {
            dateRange: function() {
                if (this.startDate !== null && this.endDate !== null) {

                    try {
                        this.validateDates();
                    } catch (e) {
                        return;
                    }

                    this.$emit('dateRangeChange', this.dateRange);
                }
            }
        },
        methods: {
            validateDates() {
                if (this.startDate !== null) {
                    if (!this.startDate.match('\\d{4}-\\d{2}-\\d{2}')) {
                        this.startDateErrorMessage = 'Invalid date provided.';
                        throw 'Invalid date';
                    }
                }

                if (this.endDate !== null) {
                    if (!this.endDate.match('\\d{4}-\\d{2}-\\d{2}')) {
                        this.endDateErrorMessage = 'Invalid date provided.';
                        throw 'Invalid date';
                    }
                }

                const startDateNumeric = parseInt(moment(this.startDate, 'YYYY-MM-DD').unix());
                const endDateNumeric = parseInt(moment(this.endDate, 'YYYY-MM-DD').unix());
                if (startDateNumeric > endDateNumeric) {
                    this.startDateErrorMessage = 'Start Date must be before the end date.';
                    this.endDateErrorMessage = 'End Date must be after the start date.';
                    throw 'Date order mismatch';
                }

                this.startDateErrorMessage = null;
                this.endDateErrorMessage = null;

            },
            startDateChangeListener(date) {
                this.startDate = moment(date, 'YYYY-MM-DD').format('YYYY-MM-DD');
                try {
                    this.validateDates();
                } catch (e) {
                    this.startDate = null;
                }
            },
            endDateChangeListener(date) {
                this.endDate = moment(date, 'YYYY-MM-DD').format('YYYY-MM-DD');
                try {
                    this.validateDates();
                } catch (e) {
                    this.endDate = null;
                }
            }
        }
    }
</script>

<style lang="scss">
    #date-range {
        padding: 10px 15px;
        position: relative;
        box-sizing: border-box;
        width: 100%;

        .vdp-datepicker {

            &::before {
                content: "";
                display: block;
                background-image: url("/assets/calendar-icon.png");
                background-size: contain;
                background-repeat: no-repeat;
                background-position: center center;
                width: 30px;
                height: 30px;
                position: absolute;
                top: 15px;
                left: 9px;
                z-index: 1;
            }

            input {
                border: 1px solid #CCC;
                height: 60px;
                line-height: 60px;
                font-size: 18px;
                padding-left: 45px;
                width: 100%;
                border-radius: 4px;
                margin-bottom: 10px;
                color: #757575;
            }
        }

        p.error {
            color: red;
            margin: 0;
            text-align: left;
            width: 100%;
            font-size: 12px;
            line-height: 14px;
            margin-bottom: 10px;

            &.disabled {
                display: none;
            }
        }
    }
</style>
