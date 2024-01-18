import { Grid, GridItem, Show, Heading } from "@chakra-ui/react";
import NavBar from "./components/NavBar";
import StaffGrid from "./components/StaffGrid";
import JobSelector from "./components/JobSelector";
import { useState } from "react";
import SortBy from "./components/SortBy";

function App() {
  const [selectedJob, setSelectedJob] = useState<string>("");

  return (
    <Grid
      templateAreas={{
        base: `"navbar" "trombi"`,
        lg: `"navbar navbar" "trombi"`,
      }}
    >
      <GridItem area="navbar" bg="#3A424E">
        <NavBar />
      </GridItem>
      <GridItem area="trombi" padding="15px">
        <Heading marginY={5}>Trombinoscope</Heading>
        <JobSelector />
        <SortBy />
        <StaffGrid />
      </GridItem>
    </Grid>
  );
}

export default App;
