<template>
  <q-layout>
    <router-view class="layout-view"></router-view>
    <div class="layout-view">
      <div class="layout-padding" v-if="combinations.length != 0">
        <div class="justify-center" v-for="(combination, index) in combinations">
          <div class="card">
            <div class="card-title text-center">
              <div class="number-circle">
                <span>{{ combination.first_number }}</span>
              </div>
              <div class="number-circle">
                <span>{{ combination.second_number }}</span>
              </div>
              <div class="number-circle">
                <span>{{ combination.third_number }}</span>
              </div>
              <div class="number-circle">
                <span>{{ combination.fourth_number }}</span>
              </div>
              <div class="number-circle">
                <span>{{ combination.fifth_number }}</span>
              </div>
              +
              <div class="number-circle extra-number">
                <span>{{ combination.first_extra_number }}</span>
              </div>
              <div class="number-circle extra-number">
                <span>{{ combination.second_extra_number }}</span>
              </div>
              <i style="cursor: pointer; color: red;" @click="deleteCombination(index)" >
                close
                <q-tooltip>
                  {{ $t("delete_combination") }}
                </q-tooltip>
              </i>
            </div>
          </div>
        </div>
      </div>
      <div class="layout-padding" v-else>
        <div class="justify-center text-center">
          {{$t('no_combinations')}}
        </div>
      </div>
    </div>
  </q-layout>
</template>

<script>
import { Dialog, Toast } from 'quasar'

export default {
  data () {
    return {
      combinations: []
    }
  },
  methods: {
    getCombinations () {
      this.combinations = this.$store.getters.getCombinations
    },
    deleteCombination (index) {
      Dialog.create({
        title: this.$t('confirm'),
        message: this.$t('are_you_sure_delete'),
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
              this.$store.commit('deleteCombination', index)
              Toast.create.positive({html: this.$t('success')})
              this.getCombinations()
            }
          }
        ]
      })
    }
  },
  mounted () {
    this.getCombinations()
  }
}
</script>

<style lang="stylus">
.number-circle {
  border-radius: 50%;
  width: 40px; 
  font-size: 15px;
  border: 1px solid rgba(0,0,0,.1);
  box-shadow: 4px 4px 7px rgba(0,0,0,0.2);
  display: inline-block;
  margin-left: 5px;
  margin-right: 7px;
  margin-top: 7px;
  margin-bottom: 9px;
}

.number-circle span {
  text-align: center;
  line-height: 40px;
  display: block;
}

.extra-number {
  background: rgb(237, 269, 183);
}
</style>
