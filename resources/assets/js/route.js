import SubjectComponent from './components/SubjectComponent.vue'
import InstructionComponent from './components/InstructionComponent.vue'

export default[
    
    { path:'/',components: {
        default: SubjectComponent,InstructionComponent,
        subject:SubjectComponent,
        instruction: InstructionComponent
      }
    },
]