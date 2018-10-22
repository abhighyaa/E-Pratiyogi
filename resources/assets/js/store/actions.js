export const actions = {
    async Set_Instructions(context,payload){
       var data
       await axios.get('http://localhost:8000/subjects/'+payload+'/get/instructions')
            .then((response)=>(data = response.data))
            .catch(function(error){console.log(error)})
            context.commit('Set_Instructions',data)
     },
     async Set_Subjects(context){
         var data
         await axios.get('http://localhost:8000/subjects/get/default')
           .then((response)=>(data = response.data))
           .catch(function(error){console.log(error)})
           context.commit('Set_Subjects',data)
     },
     async Set_Courses(context){
         var data
         await axios.get('http://localhost:8000/courses/get/all')
            .then((response)=>(data = response.data))
            .catch(function(error){console.log(error)})
            context.commit('Set_Courses',data)
     },
     async Set_Subjects_by_Branch(context, payload){
        var data
        await axios.get('http://localhost:8000/courses/branch/'+payload+'/get/subjects')
            .then((response)=>(data = response.data))
            .catch(function(error){console.log(error)})
            context.commit('Set_Subjects_by_Branch',data)
     },
     async Set_Teachers(context){
        var data
        await axios.get('http://localhost:8000/student/get/myteachers')
           .then((response)=>(data = response.data))
           .catch(function(error){console.log(error)})
           context.commit('Set_Teachers',data)
    },
 }