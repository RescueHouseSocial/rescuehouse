<template>
  <div id="DragAndDropImage">
    <div class="flex justify-center">
      <div class="py-0 px-4 md:py-8 md:px-8 mx-auto w-full md:w-1/2">
        Avatar
        <div class="grid gap-8 mb-4 md:grid-cols-1">
          <div class="items-center bg-gray-50 rounded-lg shadow sm:flex">
            <form @submit.prevent="handleUpload" class="w-full p-4">
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
                  <div v-for="file in files" :key="file.name" class="w-1/3 border border-gray-500 p-4">
                    <a @click="remove(files.indexOf(file))" class="cursor-pointer"><img class="w-20 h-auto rounded border border-gray-200" :src="generateURL(file)"/></a>
                  </div>
                </div>
              </div>
              <div class="flex justify-end">
                <button class="flex mt-4 text-white bg-gray-500 border-0 py-2 px-8 focus:outline-none hover:bg-gray-600 rounded text-lg" type="submit">
                  <span v-if="isLoading">
                    <i class="fa-solid fa-spinner fa-fw fa-spin"></i>
                  </span>
                  <span v-else>
                    Upload
                  </span>
                </button>
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
        const files = this.files;
        const formData = new FormData();
        files.forEach((file) => {
          formData.append("selectedFiles[]", file);
        });
        try {
          const response = await axios.post(route("settings.updateavatar"), formData, {
            headers: {
              "X-CSRF-TOKEN": this.csrfToken,
              "Content-Type": "multipart/form-data",
            },
          });
          if (!response.statusText == "OK") {
            throw new Error("Failed to upload files");
          }
          this.isLoading = false;
          window.location.reload();
        } catch (error) {
          console.error("Error uploading files:", error);
          this.isLoading = false;
        }
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