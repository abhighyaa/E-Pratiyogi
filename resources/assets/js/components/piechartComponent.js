function getRandomColor() {
  var letters = '0123456789ABCDEF';
  var color = '#';
  for (var i = 0; i < 6; i++) {
    color += letters[Math.floor(Math.random() * 16)];
  }
  return color;
}

// function add(a, b) {
//   return a + b;
// }

import { Pie } from 'vue-chartjs'

export default {
  extends:Pie,
  props:['value','type'],
  data(){
    return{
      labels:[],
      marks:[],
      color:[]
    };
  },
 mounted () {
    this.drawpie();
 },
 methods:{
   drawpie:function(){
     var marks=0;
     if(this.type=="marks" ){
      for (var val in this.value) {
        marks = this.value[val].right.low.length + this.value[val].right.med.length*2 +this.value[val].right.high.length*3;
        this.labels.push(val);
        this.marks.push(marks);
        this.color.push(getRandomColor());
          //var sum = this.marks.reduce(add, 0);

            //if(sum>0){
            
        //}
      }
      }
      if(this.type=="rights" ){
        for (var val in this.value) {
          marks = this.value[val].right.low.length + this.value[val].right.med.length +this.value[val].right.high.length;
          this.labels.push(val);
          this.marks.push(marks);
          this.color.push(getRandomColor());
        }   
        }

        if(this.type=="wrongs" ){
          for (var val in this.value) {
            marks = this.value[val].wrong.low.length + this.value[val].wrong.med.length +this.value[val].wrong.high.length;
            this.labels.push(val);
            this.marks.push(marks);
            this.color.push(getRandomColor());
          }  
          }
  this.renderChart({
    labels: this.labels,
    datasets: [
      {
        backgroundColor:this.color,
        data: this.marks
      }
    ]
  }, {
    responsive: true, 
    maintainAspectRatio: false,
    pieceLabel: {
      mode: 'percentage',
      precision: 1
    }
  })
 }
}
    }

