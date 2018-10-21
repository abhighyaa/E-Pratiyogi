<template>
    <div>
        <div class="card card-default">
            <div class="card-header">Details</div>
            <div class="card-body">
                <ul v-if='showcategories'>
                    <li :key="cat.id" v-for="cat in categories">
                        <button @click="showque(cat.id,subject)">{{ cat.category }}</button>
                        <br><br>
                    </li>
                </ul>

                <div v-if="showquestions">
                    <button @click="addque(subject,category)">Add question</button>
                    <br><br>
                    <div v-for="question in questions">
                        <div class="question">{{question.question}} 
                            <div class="float-right">
                                <button @click="geteditque(question.id)">Edit</button>
                                <button @click="deleteque(question.id)">Delete</button>
                            </div>
                        </div>
                        
                        <div v-if="question.type=='mcq'" v-for="i in question.choices">
                            <div class="choices"><input type="radio" :name="question.id" :checked="i==question.answer">&nbsp;&nbsp;{{i}}</div>
                        </div>
                        <div v-if="question.type=='check'" v-for="i in question.choices">
                            <div class="choices"><input type="checkbox" :name="question.id" v-model="checkanswer">&nbsp;&nbsp;{{i}}</div>
                        </div>
                        <hr>
                    </div>
                </div>

            </div>
        </div>
    </div>    
</template>