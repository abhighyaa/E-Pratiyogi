<template>
    <div class="container">
        <div class="row">
            <!-- <profile-header></profile-header> -->
            <div class="col-sm-6">First Section</div>
        <div class="col-sm-6">Second Section</div>
        </div>
        <div class="row">
           <!-- <profile-feature></profile-feature> -->
           <div class="col-sm-12">
            <b-card no-body>
            <b-tabs card>
                <b-tab  title="My Profile" active>
                    Profile
                </b-tab>
                <b-tab  title="My Subject">
                    Subjects
                </b-tab>
                <b-tab   title="My Teacher">
                    Teacher
                </b-tab>
                <b-tab title="Search Teacher">
                    Search
                </b-tab>
                <b-tab title="My Test">
                    Test
                </b-tab>
                <b-tab title="Activities">
                   Activities
                </b-tab>
            </b-tabs>
        </b-card></div>
        </div>
    </div>
</template>

<style>
.row{
    border: solid
}
</style>
