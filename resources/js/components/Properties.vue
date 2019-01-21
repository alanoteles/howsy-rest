<template>
	<div>
		<h2>Properties</h2>
		<form @submit.prevent="addProperty" class="mb-3">
			<div class="form-group mb-1">	
				<input type="text" class="form-control" placeholder="Address 1" v-model="property.address_1">
			</div>
			<div class="form-group mb-1">	
				<input type="text" class="form-control" placeholder="Address 2" v-model="property.address_2">
			</div>
			<div class="form-group mb-1">	
				<input type="text" class="form-control" placeholder="City" v-model="property.city">
			</div>
			<div class="form-group mb-1">	
				<input type="text" class="form-control" placeholder="Postcode" v-model="property.postcode">
			</div>
			<div class="form-group">	
				<button type="submit" class="btn btn-light btn-block">Save</button>
			</div>
		</form>
		
		<nav aria-label="Page navigation example">
		  <ul class="pagination">
		    <li class="page-item" v-bind:class="[{ disabled: !pagination.prev_page_url }]"><a class="page-link" href="#" @click="fetchProperties(pagination.prev_page_url)">Previous</a></li>
		    
		    <li class="page-item disabled"><a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a></li>

		    <li class="page-item" v-bind:class="[{ disabled: !pagination.next_page_url }]"><a class="page-link" href="#" @click="fetchProperties(pagination.next_page_url)">Next</a></li>
		  </ul>
		</nav>
		<div class="card card-body mb-2" v-for="property in properties" v-bind:key="property.id">
			<h4>{{ property.address_1 }}  {{ property.address_2 }}</h4>
			<p>{{ property.city }} - {{ property.postcode }}</p>
			<p v-if="property.latitude">Latitude : {{ property.latitude }} - Longitude : {{ property.longitude }}</p>
			<button @click="editProperty(property)" class="btn btn-warning mb-2">Edit</button>
			<button @click="deleteProperty(property.id)" class="btn btn-danger">Delete</button>
		</div>
	</div>
</template>

<script>
	export default {
		data() {
			return{
				properties: [],
				property: {
					id: '',
					address_1: '',
					address_2: '',
					city: '',
					postcode: ''
				},
				property_id: '',
				pagination: {},
				edit: false
			}
		},

		created() {
			this.fetchProperties();
		},

		methods: {
			fetchProperties(page_url) {
				let vm = this;
				page_url = page_url || 'api/addresses';

				fetch(page_url)
				.then(res => res.json())
				.then(res => {
						this.properties = res.data;
						vm.makePagination(res.meta, res.links);
					})
				.catch(err => console.log(err));
			},

			makePagination(meta, links){
				let pagination = {
					current_page: meta.current_page,
					last_page: meta.last_page,
					next_page_url: links.next,
					prev_page_url: links.prev,
				}

				this.pagination = pagination;
			},

			deleteProperty(id){
				if(confirm('Remove this property ?')){
					fetch(`api/address/${id}`,{
						method: 'delete'
					})
					.then(res => res.json())
					.then(data => {
						alert('Property removed !');
						this.fetchProperties();
					})
					.catch(err => console.log(err));
				}
				console.log(id);
			},

			addProperty(){
				if(this.edit === false){
					// Add
					fetch('api/address', {
						method: 'post',
						body: JSON.stringify(this.property),
						headers: {
							'content-type':'application/json'
						}
					})
					.then(res => res.json)
					.then(data => {
						this.property.address_1 = '';
						this.property.address_2 = '';
						this.property.city 		= '';
						this.property.postcode 	= '';

						alert('Property Added');
						this.fetchProperties();
					})
					.catch(err => console.log(err));
				}else{
					fetch('api/address', {
						method: 'put',
						body: JSON.stringify(this.property),
						headers: {
							'content-type':'application/json'
						}
					})
					.then(res => res.json)
					.then(data => {
						this.property.address_1 = '';
						this.property.address_2 = '';
						this.property.city 		= '';
						this.property.postcode 	= '';

						alert('Property Updated');
						this.fetchProperties();
					})
					.catch(err => console.log(err));
				}
			},
			editProperty(property){
				this.edit 					= true;
				this.property.id 			= property.id
				this.property.property_id 	= property.property_id
				this.property.address_1 	= property.address_1
				this.property.address_2 	= property.address_2
				this.property.city 			= property.city
				this.property.postcode 		= property.postcode
			}


		}
	}
</script>
