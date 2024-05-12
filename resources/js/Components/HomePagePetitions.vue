<template>
  <div class="col">
    <Link :href="route('petition.show',petition.id)" class="text-decoration-none">
      <div class="card h-100 hp">
        <img :src="'/'+petition.petition_banner" class="card-img-top" alt="..." />
        <div class="card-body">
          <h5 class="card-title">{{ petition.petition_header }}</h5>
          <p class="card-text">
            {{ petition.petition_content }}
          </p>
          <div class="progress" role="progressbar" aria-label="Danger example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar bg-danger" :style="{ 'width': progress+'%' }"></div>
          </div>
          <div class="row">
            <div class="col-12 fs-6">
              <small>{{ petition.target_sign }} imza hedefinden {{ petition.reason_count }} imza</small>
            </div>
          </div>
          <button class="btn btn-danger mt-2">Kampanyaya git</button>
        </div>
        <div class="card-footer">
          <small>3 gün önce oluşturuldu</small>
        </div>
      </div>
    </Link>
  </div>
</template>

<script>
import { Link } from '@inertiajs/vue3';
export default {
  components:{
    Link
  },
  props: {
    petition:Object
  },
  computed:{
    progress(){
      return (this.petition.reason_count/this.petition.target_sign)*100
    }
  }
};
</script>

<style>
.hp {
  transition: 0.2s;
}
.hp:hover {
  transform: scale(1.01);
}
</style>
