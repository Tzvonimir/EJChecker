<template>
  <!-- Don't drop "q-app" class -->
  <q-layout>
    <!-- Navigation Tabs -->
    <q-tabs slot="navigation" class="main-background">
      <q-tab icon="home" route="/" exact replace>{{ $t("home") }}</q-tab>
      <q-tab icon="assessment" route="/statistic" exact replace>{{ $t("statistic") }}</q-tab>
      <q-tab icon="save" route="/combinations" exact replace>{{ $t("combinations") }}</q-tab>
    </q-tabs>
    <div id="q-app">
    	<router-view></router-view>
  	</div>
  	<!-- Footer -->
    <div slot="footer" class="toolbar main-background">
      <button class="clear" @click="$refs.basicModal.open()"><i>flag</i></button>
    </div>
    <q-modal ref="basicModal">
      <span style="cursor: pointer;" class="pull-right" @click="$refs.basicModal.close()">
      	<i>close</i>
      </span>
      <h4 class="row justify-center">{{ $t("change_language") }}</h4>
      <div class="row justify-center">
	    <img src="./assets/hr.png" class="responsive local-img" v-on:click="setLocale('hr'); $refs.basicModal.close();">
	    <img src="./assets/eng.png" class="responsive local-img" v-on:click="setLocale('en'); $refs.basicModal.close();">
      </div>
    </q-modal>
  </q-layout>
</template>

<script>
/*
 * Root component
 */
export default {}
</script>

<style>
  .local-img {
  	height: 200px !important;
  	cursor: pointer;
  }

  @media (max-width: 400px) {
    .local-img {
  	  height: 50px !important;
    }
  }

  .main-background {
	background: #000080 !important;
  }
</style>
