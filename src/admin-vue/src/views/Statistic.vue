<template>
  <q-layout
    class="layout-statistic">
    <router-view class="layout-view"></router-view>
    <!-- Tabs -->
    <q-tabs
      :refs="$refs"
      default-tab="tab-1"
      slot="navigation"
      class="justify-center purple inverted navigation-tabs"
    >
      <q-tab name="tab-1" icon="looks_one">
        {{ $t('top_number') }}
      </q-tab>
      <q-tab name="tab-2" icon="folder_open">
        {{ $t('archived_combinations') }}
      </q-tab>
    </q-tabs>
    <!-- Targets -->
    <div class="layout-view" ref="tab-1">
      <div class="layout-padding">
        <div class="justify-center text-center" v-for="statistic in statistics">
          <div class="card">
            <div class="card-title">
              {{ $t("number") }} <div class="number-circle"><span>{{ statistic.number }}</span></div> {{ $t("has_been_checked") }}: {{ statistic.count }} {{ $t("times") }}.
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="layout-view" ref="tab-2">
      <div class="layout-padding">
        <div class="justify-center text-center" v-for="combination in combinations">
          <div class="card">
            <div class="row justify-center">
              <span class="on-left">
                {{$t('results_from')}}
                {{ combination.date_format }}
              </span>
              <span class="on-right">
                {{$t('cycle')}}
                {{ combination.cycle }}
              </span>
            </div>
            <div class="card-title">
              <div class="row justify-center">
                <ul>
                  <li class="number-circle">
                    <span>{{ combination.first_number.number }}</span>
                  </li>
                  <li class="number-circle">
                    <span>{{ combination.second_number.number }}</span>
                  </li>
                  <li class="number-circle">
                    <span>{{ combination.third_number.number }}</span>
                  </li>
                  <li class="number-circle">
                    <span>{{ combination.fourth_number.number }}</span>
                  </li>
                  <li class="number-circle">
                    <span>{{ combination.fifth_number.number }}</span>
                  </li>
                  <li class="add-sign">+</li>
                  <li class="number-circle extra-number">
                    <span>{{ combination.first_extra_number.number }}</span>
                  </li>
                  <li class="number-circle extra-number">
                    <span>{{ combination.second_extra_number.number }}</span>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </q-layout>
</template>

<script>
import { Loading } from 'quasar'
import axios from 'axios'
import { ResponseHelper } from '../helpers/Helpers'

export default {
  data () {
    return {
      statistics: [],
      combinations: []
    }
  },
  methods: {
    findStatistic () {
      Loading.show()
      axios.get('/api/open/combinations/get_statistics').then(response => {
        ResponseHelper.responseResolver(response, response => {
          this.statistics = response.data.statistics
          Loading.hide()
        })
      })
      .catch(error => {
        ResponseHelper.errorResolver(error)
        Loading.hide()
      })
    },
    getWinningCombinations () {
      Loading.show()
      axios.get('/api/open/combinations/get_winning_combinations').then(response => {
        ResponseHelper.responseResolver(response, response => {
          this.combinations = response.data.combinations
          Loading.hide()
        })
      })
      .catch(error => {
        ResponseHelper.errorResolver(error)
        Loading.hide()
      })
    }
  },
  mounted () {
    this.findStatistic()
    this.getWinningCombinations()
  }
}
</script>

<style lang="stylus">
.add-sign{
  display: inline-block;
}

.number-circle {
  border-radius: 50%;
  width: 40px; 
  font-size: 15px;
  border: 1px solid rgba(0,0,0,.1);
  box-shadow: 4px 4px 7px rgba(0,0,0,0.2);
  display: inline-block;
  margin-left: 5px;
  margin-right: 7px;
}

.number-circle span {
  text-align: center;
  line-height: 40px;
  display: block;
}

.navigation-tabs {
  margin-top: 5px;
}

.layout-statistic > .layout-header {
  box-shadow: none;
}

.layout-header {
  background: none;
}

.extra-number {
  background: rgb(237, 269, 183);
}
</style>
