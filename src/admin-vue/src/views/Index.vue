<template>
  <q-layout>
    <router-view class="layout-view"></router-view>
    <div class="layout-view">
      <div class="contain">
        <div class="row justify-center">
          <ul class="numbers" id="all-numbers">
            <li class="number-circle" v-on:click="numberClicked($event, number.id)" v-for="number in numbers">
              <span>{{ number.number }}</span>
            </li>
          </ul>
        </div>

        <div class="row justify-center">
          <ul class="numbers" id="all-extra-numbers">
            <li class="number-circle extra-number" v-on:click="extraNumberClicked($event, extraNumber.id)" v-for="extraNumber in extraNumbers">
              <span>{{ extraNumber.number }}</span>
            </li>
          </ul>
        </div>

        <div class="row justify-center">
          <button class="push submit-button" v-on:click="confirmCombination" :disabled="numberCounter < 5 || extraNumberCounter < 2">
            {{ $t("check") }}
          </button>
        </div>
      </div>
    </div>

    <q-modal ref="combinationDetails">
      <div class="layout-view justify-center">
        <div class="contain" style="margin-right: 30px;">
          <div class="row justify-center">
            <ul class="numbers detail-numbers-circle" id="all-numbers">
              <li>
                <span>{{ combination.first_number }}</span>
              </li>
              <li>
                <span>{{ combination.second_number }}</span>
              </li>
              <li>
                <span>{{ combination.third_number }}</span>
              </li>
              <li>
                <span>{{ combination.fourth_number }}</span>
              </li>
              <li>
                <span>{{ combination.fifth_number }}</span>
              </li>
              <li class="extra-number">
                <span>{{ combination.first_extra_number }}</span>
              </li>
              <li class="extra-number">
                <span>{{ combination.second_extra_number }}</span>
              </li>
            </ul>
          </div>

          <div class="justify-center row">
            <span> {{ $t("combination_has_been_played") }} {{ combinationCount.combination_count }} {{ $t("times") }} </span>
          </div>

          <div class="justify-center row">
            <span> {{ $t("this_week_played") }} {{ combinationCount.current_combination_count }} {{ $t("times") }} </span>
          </div>

          <div class="justify-center row" v-if="combinationCount.current_combination_count >= 1" style="margin-top: 15px;">
            <button class="push submit-button" @click="generateCombination(), $refs.combinationDetails.close()">
              {{ $t("generate") }}
            </button>
          </div>

          <div class="justify-center row" style="margin-top: 15px;">
            {{ $t("similar_combinations") }}
          </div>
          <div class="justify-center row" v-for="combination in combinationCount.existing_combinations" @click="saveExistingCombination(combination)">
            <ul class="numbers detail-numbers-circle" id="all-numbers">
              <li>
                <span>{{ combination.first_number.number }}</span>
              </li>
              <li>
                <span>{{ combination.second_number.number }}</span>
              </li>
              <li>
                <span>{{ combination.third_number.number }}</span>
              </li>
              <li>
                <span>{{ combination.fourth_number.number }}</span>
              </li>
              <li>
                <span>{{ combination.fifth_number.number }}</span>
              </li>
              <li class="extra-number">
                <span>{{ combination.first_extra_number.number }}</span>
              </li>
              <li class="extra-number">
                <span>{{ combination.second_extra_number.number }}</span>
              </li>
            </ul>
          </div>

          <div class="row justify-center">
            <button class="push submit-button" @click="$refs.combinationDetails.close()">
              {{ $t("close") }}
            </button>
            <button class="push submit-button" @click="storeCombination(), $refs.combinationDetails.close()">
              {{ $t("submit") }}
            </button>
          </div>

        </div>
      </div>
    </q-modal>
  </q-layout>
</template>

<script>
import { Loading, Dialog, Toast } from 'quasar'
import axios from 'axios'
import { ResponseHelper } from '../helpers/Helpers'

export default {
  data () {
    return {
      numberCounter: 0,
      extraNumberCounter: 0,
      dataNumbers: [],
      dataExtraNumbers: [],
      numbers: [],
      extraNumbers: [],
      combination: {},
      combinationCount: []
    }
  },
  methods: {
    numberClicked (event, number) {
      if (this.numberCounter < 5 && event.currentTarget.classList.value === 'number-circle') {
        event.currentTarget.classList.toggle('active-number')
        this.numberCounter += 1
        this.dataNumbers.push(number)
        if (this.numberCounter > 4) {
          this.changeChildElementsBackground('all-numbers', 'li', 'rgb(238, 236, 225)')
        }
      }
      else {
        if (event.currentTarget.classList.value !== 'number-circle') {
          event.currentTarget.classList.toggle('active-number')
          var index = this.dataNumbers.indexOf(number)
          this.dataNumbers.splice(index, 1)
          this.numberCounter = this.numberCounter - 1
          if (this.numberCounter < 5) {
            this.changeChildElementsBackground('all-numbers', 'li', 'white')
          }
        }
      }
    },
    extraNumberClicked (event, number) {
      if (this.extraNumberCounter < 2 && event.currentTarget.classList.value === 'number-circle extra-number') {
        event.currentTarget.classList.toggle('active-number')
        this.extraNumberCounter += 1
        this.dataExtraNumbers.push(number)
        if (this.extraNumberCounter > 1) {
          this.changeChildElementsBackground('all-extra-numbers', 'li', 'rgb(238, 236, 225)')
        }
      }
      else {
        if (event.currentTarget.classList.value !== 'number-circle extra-number') {
          event.currentTarget.classList.toggle('active-number')
          var index = this.dataExtraNumbers.indexOf(number)
          this.dataExtraNumbers.splice(index, 1)
          this.extraNumberCounter = this.extraNumberCounter - 1
          if (this.extraNumberCounter < 2) {
            this.changeChildElementsBackground('all-extra-numbers', 'li', 'rgb(237, 269, 183)')
          }
        }
      }
    },
    confirmCombination () {
      Dialog.create({
        title: this.$t('confirm'),
        message: this.$t('are_you_sure_numbers'),
        buttons: [
          {
            label: this.$t('disagree'),
            handler () {
              console.log('Disagreed...')
            }
          },
          {
            label: this.$t('agree'),
            handler: () => {
              this.saveCombination()
            }
          }
        ]
      })
    },
    saveCombination () {
      this.sortNumbers()
      this.sortExtraNumbers()
      this.combination = {
        first_number: this.dataNumbers[0],
        second_number: this.dataNumbers[1],
        third_number: this.dataNumbers[2],
        fourth_number: this.dataNumbers[3],
        fifth_number: this.dataNumbers[4],
        first_extra_number: this.dataExtraNumbers[0],
        second_extra_number: this.dataExtraNumbers[1]
      }
      axios.post('/api/open/combinations/check_combination', this.combination)
      .then(function (response) {
        this.combinationCount = response.data
        let mainThis = this
        Dialog.create({
          title: this.$t('number_of_combinations'),
          message: this.$t('combination_has_been_played') +
          ': ' +
           response.data.combination_count +
           ' ' +
           this.$t('times') +
           '!' +
           '<br/>' +
           this.$t('this_week_played') +
           ': ' +
           response.data.current_combination_count +
           ' ' +
           this.$t('times') +
           '!' +
           '<br/>' +
           this.$t('do_save_combination'),
          buttons: [
            {
              label: this.$t('details'),
              handler () {
                mainThis.$refs.combinationDetails.open()
              }
            },
            {
              label: this.$t('disagree'),
              handler () {
                console.log('Disagreed...')
              }
            },
            {
              label: this.$t('agree'),
              handler: () => {
                this.storeCombination()
                Toast.create.positive({html: this.$t('success')})
              }
            }
          ]
        })
      }.bind(this))
      .catch(function (error) {
        ResponseHelper.errorResolver(error)
        Toast.create.negative({html: this.$t('error')})
      }.bind(this))
    },
    getNumbers () {
      Loading.show()
      axios.get('/api/open/numbers/get_numbers').then(response => {
        ResponseHelper.responseResolver(response, response => {
          this.numbers = response.data.numbers.data
          Loading.hide()
        })
      })
      .catch(error => {
        ResponseHelper.errorResolver(error)
        Loading.hide()
      })
    },
    getExtraNumbers () {
      Loading.show()
      axios.get('/api/open/extra_numbers/get_extra_numbers').then(response => {
        ResponseHelper.responseResolver(response, response => {
          this.extraNumbers = response.data.extra_numbers.data
          Loading.hide()
        })
      })
      .catch(error => {
        ResponseHelper.errorResolver(error)
        Loading.hide()
      })
    },
    changeChildElementsBackground (idName, elementName, color) {
      var nodes = document.getElementById(idName).childNodes
      for (var i = 0; i < nodes.length; i++) {
        if (nodes[i].nodeName.toLowerCase() === elementName) {
          nodes[i].style.background = color
        }
      }
    },
    storeCombination () {
      this.$store.commit('setCombination', this.combination)
    },
    generateCombination () {
      Loading.show()
      axios.get('/api/open/extra_numbers/get_random').then(response => {
        ResponseHelper.responseResolver(response, response => {
          this.dataExtraNumbers[0] = response.data.numbers[0].number
          this.dataExtraNumbers[1] = response.data.numbers[1].number

          Loading.hide()
        })
      })
      .catch(error => {
        ResponseHelper.errorResolver(error)
      })
      Loading.show()
      axios.get('/api/open/numbers/get_random').then(response => {
        ResponseHelper.responseResolver(response, response => {
          this.dataNumbers[0] = response.data.numbers[0].number
          this.dataNumbers[1] = response.data.numbers[1].number
          this.dataNumbers[2] = response.data.numbers[2].number
          this.dataNumbers[3] = response.data.numbers[3].number
          this.dataNumbers[4] = response.data.numbers[4].number

          Loading.hide()
          this.saveCombination()
        })
      })
      .catch(error => {
        ResponseHelper.errorResolver(error)
        Loading.hide()
      })
    },
    saveExistingCombination (combination) {
      this.$refs.combinationDetails.close()
      Loading.show()
      this.dataNumbers[0] = combination.first_number.number
      this.dataNumbers[1] = combination.second_number.number
      this.dataNumbers[2] = combination.third_number.number
      this.dataNumbers[3] = combination.fourth_number.number
      this.dataNumbers[4] = combination.fifth_number.number
      this.dataExtraNumbers[0] = combination.first_number.number
      this.dataExtraNumbers[1] = combination.second_number.number
      Loading.hide()
      this.saveCombination()
    },
    sortNumbers () {
      this.dataNumbers.sort((a, b) => a > b)
    },
    sortExtraNumbers () {
      this.dataExtraNumbers.sort((a, b) => a > b)
    }
  },
  mounted () {
    this.getNumbers()
    this.getExtraNumbers()
  }
}
</script>

<style lang="stylus">
.extra-numbers {
  padding-left: 20px;
}

.submit-button {
  margin-top: 5px;
  margin-left: 25px;
  margin-bottom: 50px;
}

.main-panel {
  margin-top: 20% !important;
}

.active-number {
  background-color: #C0C0C0 !important;
}

.numbers-col > td { 
  padding: 8px 9px !important;
  margin: 0 auto !important;
  border: 2px solid #a1a1a1;
  border-radius: 100px;
  background-color: blue;
}

.extra-numbers-col > td { 
  padding: 8px 13px !important;
  margin: 0 auto !important;
  border: 2px solid #a1a1a1;
  border-radius: 100px;
  background-color: blue;
}

.v-hidden {
  visibility: hidden;
}

.numbers {
  max-width: 750px;
}

.numbers li {
  list-style-type: none;
  border-radius: 50%;
  width: 60px; 
  font-size: 32px;
  border: 1px solid rgba(0,0,0,.1);
  float: left;
  margin: 0 10px 10px 0;
  cursor: pointer;
  box-shadow: 4px 4px 7px rgba(0,0,0,0.2);
}

.numbers li > span {
  text-align: center;
  line-height: 60px;
  display: block;
}
.detail-numbers-circle li {
  width: 40px !important; 
  font-size: 15px !important;
}

.detail-numbers-circle span {
  line-height: 40px !important;
}
.disable-numbers {
  background: rgb(238, 236, 225)
}

.extra-number {
  background: rgb(237, 269, 183);
}

</style>
