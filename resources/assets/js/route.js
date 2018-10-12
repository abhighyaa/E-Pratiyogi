// import SubjectComponent from './components/SubjectComponent.vue'
import Instructions from './components/Instructions.vue'

export default[
    
    { path:'/studnt/home',
      components: {
                    default:Instructions,
                    instruction: Instructions
                 }
    },
]