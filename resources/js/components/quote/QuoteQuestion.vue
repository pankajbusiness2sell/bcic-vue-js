<template>
    <div class="offcanvas-body">
      <div class="bcic_quotes_questions">
        <div class="form-check" v-for="question in quoteQuestions" :key="question.id">
          <input
            class="form-check-input"
            :id="'defaultCheck' + question.id"
            type="checkbox"
            :value="question.id"
            v-model="selectedQuestions"
          />
          <label class="form-check-label" :for="'defaultCheck' + question.id">
            {{ question.question }}
          </label>
        </div>
        <button type="submit" @click="saveQuestions" class="btn btn-primary mt-3">Save Question</button>
      </div>
    </div>
  </template>
  

  <script setup>
  import { ref, watch, onMounted } from 'vue';
  
  const props = defineProps({
    quoteQuestions: {
      type: Object,
      required: false,
      default: () => [],
    },
    questionIds: {
      type: Object,
      required: false,
      default: () => [],
    },
  });
  
  const emit = defineEmits(['save-questions']);
  
  const selectedQuestions = ref([]);
  
  const setSelectedQuestions = () => {
    selectedQuestions.value = [...props.questionIds.map(id => parseInt(id))];
  };
  
  // Set selectedQuestions when the component is mounted
  onMounted(() => {
    setSelectedQuestions();
  });
  
  // Watch for changes in questionIds prop
  watch(() => props.questionIds, (newVal) => {
    setSelectedQuestions();
  });
  
  const saveQuestions = () => {
    emit('save-questions', selectedQuestions.value);
  };
  </script>
  