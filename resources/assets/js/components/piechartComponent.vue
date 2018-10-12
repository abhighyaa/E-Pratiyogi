
<script>
import VueChartJs from 'vue-chart-js'
    export default {
          extends: VueChartJs.Pie,
    mounted () {
    this.renderChart({
        labels: ['VueJs', 'EmberJs', 'ReactJs', 'AngularJs'],
          datasets: [
        {
          backgroundColor: [
            '#41B883',
            '#E46651',
            '#00D8FF',
            '#DD1B16'
          ],
          data: [1, 2, 3, 1]
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
</script>

