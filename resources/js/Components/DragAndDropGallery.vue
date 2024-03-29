<template>
  <div id="DragAndDropGallery">
    <div class="flex justify-center">
      <div class="mx-auto w-full">
        <div class="grid gap-8 mb-4 md:grid-cols-1">
          <div class="items-center bg-gray-50 rounded-lg shadow p-4">
            <label for="body" clas="leading-7 text-sm text-gray-600">Gallery</label>
            <form @submit.prevent="handleUpload">
              <div
                class="border-dashed border-2 border-gray-200 bg-gray-100 p-16 text-center"
                :style="isDragging && 'border-color: rgb(251 146 60);'"
                @dragover="dragover"
                @dragleave="dragleave"
                @drop="drop"
              >
                <input
                  type="file"
                  multiple
                  name="file"
                  id="fileInput"
                  class="hidden-input"
                  @change="onChange"
                  ref="file"
                  accept=".pdf,.jpg,.jpeg,.png"
                />
                <label for="fileInput">
                  <div v-if="isDragging">
                    <p>Release to drop files here.</p>
                    <p>&nbsp;</p>
                  </div>
                  <div v-else>
                    <p>Drop files here or <u>click here</u> to upload.</p>
                    <p>Select file to remove</p>
                  </div>
                </label>
                <div class="flex flex-wrap justify-center mt-4" v-if="files.length">
                  <div v-for="file in files" :key="file.name" class="border border-gray-500 p-4">
                    <a @click="remove(files.indexOf(file))" class="cursor-pointer"><img class="w-20 h-auto rounded border border-gray-200" :src="generateURL(file)"/></a>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

  import axios from "axios";

  export default {
    props:["postId"],
    data() {
      return {
        isLoading: false,
        isDragging: false,
        files: [],
      };
    },
    methods: {
      generateURL(file) {
        let fileSrc = URL.createObjectURL(file);
        setTimeout(() => {
          URL.revokeObjectURL(fileSrc);
        }, 1000);
        return fileSrc;
      },
      async handleUpload() {
        this.isLoading = true;
        for (const file of this.files) {
          const formData = new FormData();
          formData.append("selectedFiles[]", file);
          formData.append("postId", this.postId);
          try {
            const response = await axios.post(route("gallery.store"), formData, {
              headers: {
                "X-CSRF-TOKEN": this.csrfToken,
                "Content-Type": "multipart/form-data",
              },
            });
            this.$emit("gallery-add", response.data.galleryId);
          } catch (error) {
            console.error(error); 
          }
        };
      },
      onChange() {
        const self = this;
        let incomingFiles = Array.from(this.$refs.file.files);
        const fileExist = self.files.some((r) =>
          incomingFiles.some(
            (file) => file.name === r.name && file.size === r.size
          )
        );
        if (fileExist) {
          self.showMessage = true;
          alert("New upload contains files that already exist");
        } else {
          self.files.push(...incomingFiles);
          this.handleUpload();
        }
      },
      dragover(e) {
        e.preventDefault();
        this.isDragging = true;
      },
      dragleave() {
        this.isDragging = false;
      },
      drop(e) {
        e.preventDefault();
        this.$refs.file.files = e.dataTransfer.files;
        this.onChange();
        this.isDragging = false;
      },
      remove(i) {
        this.files.splice(i, 1);
      },
    },
  };

</script>

<style>

  .hidden-input {
    opacity: 0;
    overflow: hidden;
    position: absolute;
    width: 1px;
    height: 1px;
  }

</style>